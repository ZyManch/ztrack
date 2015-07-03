<?php

/**
* This is the model class for table "project_database".
*
* The followings are the available columns in table 'project_database':
*/
class ProjectDatabase extends CProjectDatabase {

    const DATABASE_DELIMITER = ';';

    protected $_activeDatabase;
    protected $_activeTable;
    /** @var  CDbConnection */
    protected $_connect;
    protected $_tables;
    protected $_columns;
    protected $_pk;

    public function getDatabases() {
        return array_filter(
            explode(self::DATABASE_DELIMITER, $this->database_list)
        );
    }

    public function connect($database, $table) {
        if (!in_array($database,$this->getDatabases())) {
            throw new Exception('Database not found');
        }
        $this->_activeDatabase = $database;
        $dsn = 'mysql:host='.$this->hostname.';';
        if ($this->port) {
            $dsn.='port='.$this->port.';';
        }
        $this->_connect = new CDbConnection($dsn,$this->username,$this->password);
        $this->_connect->createCommand('use '.$database)->execute();
        $this->_activeTable = $table;
    }

    public function getCurrentDatabase() {
        return $this->_activeDatabase;
    }

    public function getCurrentTable() {
        return $this->_activeTable;
    }

    public function getTables() {
        if (is_null($this->_tables)) {
            $this->_tables = $this->
                _connect->
                createCommand('SHOW TABLE STATUS')->
                queryAll();
        }
        return $this->_tables;
    }

    public function getGroupedTables() {
        $tables = array();
        foreach ($this->getTables() as $table) {
            $name = explode('_',$table['Name'], 2);
            if (!isset($tables[$name[0]])) {
                $tables[$name[0]] = array();
            }
            $tables[$name[0]][] = $table;
        }
        return $tables;
    }

    public function getTableDataProvider() {
        $query = $this->
            _connect->
            createCommand()->
            select(array('*'))->
            from($this->getCurrentTable());
        $filters = Yii::app()->request->getParam('filter',array());
        foreach ($this->getCurrentColumns() as $column) {
            $name = $column->name;
            if (!isset($filters[$name]) || !$filters[$name]) {
                continue;
            }
            $value = $filters[$name];
            $query->where('`'.$column->name.'` = ?',array($value));
        }
        return new CSqlDataProvider($query,array(
            'pagination' => array(
                'pageSize' => 40
            )
        ));
    }

    public function getTableColumns() {
        $result = array();
        $filters = Yii::app()->request->getParam('filter',array());
        foreach ($this->getCurrentColumns() as $column) {
            $name = $column->name;
            $row = array(
                'class'=>'CDataColumn',
                'name' => $column->name,
                'filter' => CHtml::textField(
                    'filter['.$name.']',
                    isset($filters[$name]) ? $filters[$name] : ''
                )
            );
            switch ($column->type) {
                case 'text':
                    $row['value'] = function($row) use($name) {
                        if (strlen($row[$name]) < 128) {
                            return $row[$name];
                        }
                        return substr($row[$name],0,128).'...';
                    };
                    break;
            }
            $result[] = $row;
        }
        $projectDatabase =$this;
        $result[] = array(
            'class'=>'CButtonColumn',
            'template' => '{update}{delete}',
            'updateButtonUrl'=>function ($data) use ($projectDatabase) {
                return CHtml::normalizeUrl(array(
                    'project/view',
                    'id' => $projectDatabase->project_id,
                    'module'=>'database',
                    'action' => 'update',
                    'database' => $projectDatabase->getCurrentDatabase(),
                    'table' => $projectDatabase->getCurrentTable(),
                    'row_id' => reset($data)
                ));
            },
            'deleteButtonUrl'=>function ($data) use ($projectDatabase) {
                return CHtml::normalizeUrl(array(
                    'project/view',
                    'id' => $projectDatabase->project_id,
                    'module'=>'database',
                    'action' => 'delete',
                    'database' => $projectDatabase->getCurrentDatabase(),
                    'table' => $projectDatabase->getCurrentTable(),
                    'row_id' => reset($data)
                ));
            }
        );
        return $result;
    }

    /**
     * @return DatabaseColumn[]
     */
    public function getCurrentColumns() {
        if (is_null($this->_columns)) {
            $columns = $this->
                _connect->
                createCommand('SHOW COLUMNS FROM  `' . $this->getCurrentTable() . '`')->
                queryAll();
            $this->_columns = array();
            foreach ($columns as $column) {
                $type = explode(' ',$column['Type'], 2);
                $params = array_filter(explode(' ',isset($type[1])? trim($type[1]) : ''));
                if ($column['Extra']) {
                    $params[] = $column['Extra'];
                }
                $type = explode('(',$type[0],2);
                $size = (isset($type[1]) ? rtrim($type[1],')') : 0);
                $type = strtolower($type[0]);
                $name = $column['Field'];
                if (!$this->_pk || $column['Key'] == 'PRI') {
                    $this->_pk = $name;
                }
                $isNull = (strtoupper($column['Null']) == 'YES');
                $this->_columns[$name] = DatabaseColumn::create(array(
                    'name' => $name,
                    'type' => $type,
                    'size' => $size,
                    'params' => $params,
                    'null' => $isNull,
                    'key' => $column['Key'],
                    'default' => $column['Default'],
                    'ai' => in_array('auto_increment',$params),
                    'attr' => in_array('unsigned zerofill',$params) ? 'zerofill' :
                        (in_array('unsigned',$params) ? 'unsigned' :
                            (in_array('on update CURRENT_TIMESTAMP',$params) ? 'timestamp' :
                                (in_array('binary',$params) ? 'binary' : ''))),
                    'default_type' => is_null($column['Default']) ?
                        ($isNull ? DatabaseColumn::DEFAULT_TYPE_NULL: DatabaseColumn::DEFAULT_TYPE_NO) :
                        ($column['Default'] == 'CURRENT_TIMESTAMP' ?
                            DatabaseColumn::DEFAULT_TYPE_TIMESTAMP :
                            DatabaseColumn::DEFAULT_TYPE_VALUE),
                ));
            }
        }
        return $this->_columns;
    }

    public function getRow($id) {
        $pkField = $this->getPk();
        $row = $this->
            _connect->
            createCommand()->
            from($this->getCurrentTable())->
            where($pkField.'='.intval($id))->
            queryRow();
        if (!$row) {
            throw new CHttpException(404,'Row not found');
        }
        return $row;
    }

    public function updateRow($id, $newValues) {
        $pkField = $this->getPk();
        $oldValues = $this->getRow($id);
        $diff = array();
        foreach ($oldValues as $name => $oldValue) {
            $newValue = (array_key_exists($name, $newValues) ? $newValues[$name] : '');
            if (is_null($oldValue) !== is_null($newValue)) {
                $diff[$name] = $newValue;
            } else if ($newValue != $oldValue) {
                $diff[$name] = $newValue;
            }
        }
        if (!$diff) {
            return false;
        }
        $command = $this->_connect->createCommand();
        $lines=array();
        foreach($diff as $name=>$value) {
            $lines[] = $this->_connect->quoteColumnName($name) . '=' .
                (is_null($value) ? 'null' : $this->_connect->quoteValue($value));
        }
        $sql=sprintf(
            'UPDATE %s.%s SET %s WHERE %s = %d',
            $this->_connect->quoteTableName($this->getCurrentDatabase()),
            $this->_connect->quoteTableName($this->getCurrentTable()),
            implode(', ', $lines),
            $pkField,
            $id
        );
        $command->setText($sql)->execute();
        return $sql;
    }

    public function insertRow($values) {
        $command = $this->_connect->createCommand();
        $params = array();
        $names = array();
        foreach($values as $name=>$value)
        {
            $names[]=$this->_connect->quoteColumnName($name);
            $params[] = is_null($value) ? 'null' : $this->_connect->quoteValue($value);
        }
        $sql=sprintf(
            'INSERT INTO %s.%s (%s) VALUES (%s)',
            $this->_connect->quoteTableName($this->getCurrentDatabase()),
            $this->_connect->quoteTableName($this->getCurrentTable()),
            implode(', ',$names),
            implode(', ', $params)
        );
        $command->setText($sql)->execute();
        return $sql;
    }

    public function updateColumn($oldColumnName, DatabaseColumn $column) {
        $sql = sprintf(
            'ALTER TABLE  `%s`.`%s` CHANGE  `%s`  %s',
            $this->_activeDatabase,
            $this->_activeTable,
            $oldColumnName,
            $column
        );
        $command = $this->_connect->createCommand();
        $command->setText($sql)->execute();
        return $sql;
    }

    public function createColumn(DatabaseColumn $column, $position, $afterColumn = null) {
        $sql = sprintf(
            'ALTER TABLE  `%s`.`%s` ADD %s  %s',
            $this->_activeDatabase,
            $this->_activeTable,
            $column,
            $position == 'after' ? 'AFTER `'.$afterColumn.'`' : 'FIRST'
        );
        $command = $this->_connect->createCommand();
        $command->setText($sql)->execute();
        return $sql;
    }

    public function deleteColumn(DatabaseColumn $column) {
        $sql = sprintf(
            'ALTER TABLE `%s`.`%s` DROP `%s`',
            $this->_activeDatabase,
            $this->_activeTable,
            $column->name
        );
        $command = $this->_connect->createCommand();
        $command->setText($sql)->execute();
        return $sql;
    }

    public function createTable($tableName, $columns) {
        $sqlColumns= array();
        $pk = null;
        foreach ($columns as $column) {
            if (!$pk) {
                $pk = $column->name;
            }
            $sqlColumns[] = (string)$column;
        }
        $sqlColumns[] = sprintf('PRIMARY KEY (`%s`)',$pk);
        $sql = sprintf(
            'CREATE TABLE `%s`.`%s` (%s)  %s',
            $this->_activeDatabase,
            $tableName,
            implode(",\n",$sqlColumns),
            'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1'
        );
        $command = $this->_connect->createCommand();
        $command->setText($sql)->execute();
        return $sql;
    }

    public function exec($sql) {
        $command = $this->_connect->createCommand($sql);
        if (strtolower(substr(ltrim($sql),0,6))=='select') {
            return $command->queryAll();
        }
        $command->execute();
        return true;
    }

    public function getBlankRow() {
        $row = array();
        foreach ($this->getCurrentColumns() as $column) {
            $row[$column->name] = ($column->default=='CURRENT_TIMESTAMP' ? date('Y-m-d H:i:s') : $column->default);
        }
        return $row;
    }

    public function getPk() {
        if (!$this->_pk) {
            $this->getCurrentColumns();
        }
        return $this->_pk;
    }

}
