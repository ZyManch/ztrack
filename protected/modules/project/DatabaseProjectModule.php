<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 30.06.2015
 * Time: 10:25
 */
class DatabaseProjectModule extends AbstractProjectModule {

    function getModuleName() {
        return 'database';
    }

    public function accessRules() {
        return  array_merge(
            array(
                array('allow',
                    'actions' => array('index','manage','data','sql',
                        'insert','update','delete'),
                    'roles'=>array(PERMISSION_DATABASE_VIEW),
                ),
                array('allow',
                    'actions' => array('structure','columnUpdate','columnCreate','columnDelete',
                    'tableCreate'),
                    'roles'=>array(PERMISSION_DATABASE_VIEW),
                ),
                array('allow',
                    'actions' => array('manage'),
                    'roles'=>array(PERMISSION_DATABASE_MANAGE),
                )
            ),
            parent::accessRules()
        );
    }

    public function getTabs() {
        return array(
            array(
                'label' => 'Database',
            )
        );
    }

    public function actionUpdate() {
        $row_id = Yii::app()->request->getParam('row_id');
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $row = $projectDatabase->getRow($row_id);
        $request = Yii::app()->request;
        if ($request->isPostRequest) {
            $nulls = $request->getParam('nulls',array());
            $row = $request->getParam('values',array());
            foreach ($nulls as $field => $null) {
                $row[$field] = null;
            }
            try {
                $sql = $projectDatabase->updateRow($row_id, $row);
                Yii::app()->user->setSQLFlash($sql);
                $this->redirect(array(
                    'action' => 'data',
                    'database' => $projectDatabase->getCurrentDatabase(),
                    'table' => $projectDatabase->getCurrentTable()
                ));
            } catch (CDbException $e) {
                Yii::app()->user->setErrorFlash(
                    'database',
                    'Error: :message',
                    array(':message' => nl2br(htmlspecialchars($e->getMessage())))
                );
            }

        }
        $this->renderPartial('//modules/project/database/_update',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase,
            'row' => $row
        ));
    }

    public function actionColumnUpdate() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $columns = $projectDatabase->getCurrentColumns();
        $request = Yii::app()->request;
        $columnName = $request->getParam('column');
        if (!$columnName || !isset($columns[$columnName])) {
            throw new CHttpException(404, 'Column not found');
        }
        $column = $columns[$columnName];
        $newColumns = $request->getParam('columns',array());
        if ($request->isPostRequest && isset($newColumns[$columnName])) {
            $newColumn = DatabaseColumn::create($newColumns[$columnName]);
            if (!$newColumn->isEqual($column)) {
                try {
                    $sql = $projectDatabase->updateColumn($column->name, $newColumn);
                    Yii::app()->user->setSQLFlash($sql);
                    $this->redirect(array(
                        'action' => 'structure',
                        'database' => $projectDatabase->getCurrentDatabase(),
                        'table' => $projectDatabase->getCurrentTable()
                    ));
                } catch (CDbException $e) {
                    Yii::app()->user->setErrorFlash(
                        'database',
                        'Error: :message',
                        array(':message' => nl2br(htmlspecialchars($e->getMessage())))
                    );
                }
            }
        }
        $this->renderPartial('//modules/project/database/_columnUpdate',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase,
            'column' => $column
        ));
    }

    public function actionColumnCreate() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $request = Yii::app()->request;
        $count = min(100,max(1,(int)$request->getParam('count',1)));
        $columns = $request->getParam('columns',array());
        if ($request->isPostRequest && $columns) {
            $position = $request->getParam('position','first');
            $afterColumn = $request->getParam('after_column');
            try {
                $sql = array();
                foreach ($columns as $column) {
                    $column = DatabaseColumn::create($column);
                    if ($column->name) {
                        $sql[] = $projectDatabase->createColumn($column, $position, $afterColumn);
                        $afterColumn = $column->name;
                    }
                }
                Yii::app()->user->setSQLFlash(implode(";\n",$sql));

            } catch (CDbException $e) {
                Yii::app()->user->setErrorFlash(
                    'database',
                    'Error: :message',
                    array(':message' => nl2br(htmlspecialchars($e->getMessage())))
                );
            }
            $this->redirect(array(
                'action' => 'structure',
                'database' => $projectDatabase->getCurrentDatabase(),
                'table' => $projectDatabase->getCurrentTable()
            ));

        }
        $this->renderPartial('//modules/project/database/_columnCreate',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase,
            'count' => $count
        ));
    }

    public function actionColumnDelete() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $columns = $projectDatabase->getCurrentColumns();
        $request = Yii::app()->request;
        $columnName = $request->getParam('column');
        if (!isset($columns[$columnName])) {
            throw new CHttpException(404,'Column not found');
        }
        try {
            $sql = $projectDatabase->deleteColumn($columns[$columnName]);
            Yii::app()->user->setSQLFlash($sql);
        } catch (CDbException $e) {
            Yii::app()->user->setErrorFlash(
                'database',
                'Error: :message',
                array(':message' => nl2br(htmlspecialchars($e->getMessage())))
            );
        }
        $this->redirect(array(
            'action' => 'structure',
            'database' => $projectDatabase->getCurrentDatabase(),
            'table' => $projectDatabase->getCurrentTable()
        ));

    }

    public function actionTableCreate() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $request = Yii::app()->request;
        $count = min(100,max(1,(int)$request->getParam('count',1)));
        $columns = $request->getParam('columns',array());
        $tableName = $request->getParam('table_name','');
        if ($request->isPostRequest && $columns) {
            try {
                if (!$tableName) {
                    throw new Exception('Missed table name');
                }
                $tableColumns = array();
                foreach ($columns as $column) {
                    $column = DatabaseColumn::create($column);
                    if ($column->name) {
                        $tableColumns[] = $column;
                    }
                }
                if ($tableColumns) {
                    $sql = $projectDatabase->createTable($tableName, $tableColumns);
                    Yii::app()->user->setSQLFlash($sql);
                    $this->redirect(array(
                        'action' => 'structure',
                        'database' => $projectDatabase->getCurrentDatabase(),
                        'table' => $tableName
                    ));
                }

            } catch (CDbException $e) {
                Yii::app()->user->setErrorFlash(
                    'database',
                    'Error: :message',
                    array(':message' => nl2br(htmlspecialchars($e->getMessage())))
                );
            }
        }
        $this->renderPartial('//modules/project/database/_tableCreate',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase,
            'count' => $count
        ));
    }

    public function actionData() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $this->renderPartial('//modules/project/database/_data',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase
        ));
    }

    public function actionInsert() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $row = $projectDatabase->getBlankRow();
        $request = Yii::app()->request;
        if ($request->isPostRequest) {
            $nulls = $request->getParam('nulls',array());
            $row = $request->getParam('values',array());
            foreach ($nulls as $field => $null) {
                $row[$field] = null;
            }
            try {
                $sql = $projectDatabase->insertRow($row);
                Yii::app()->user->setSQLFlash($sql);
                $this->redirect(array(
                    'action' => 'data',
                    'database' => $projectDatabase->getCurrentDatabase(),
                    'table' => $projectDatabase->getCurrentTable()
                ));
            } catch (CDbException $e) {
                Yii::app()->user->setErrorFlash(
                    'database',
                    'Error: :message',
                    array(':message' => nl2br(htmlspecialchars($e->getMessage())))
                );
            }

        }
        $this->renderPartial('//modules/project/database/_insert',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase,
            'row' => $row
        ));
    }

    public function actionSql() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $request = Yii::app()->request;
        $rows = null;
        $sql = $request->getParam('sql',sprintf(
            'SELECT * FROM %s.%s',
            $projectDatabase->getCurrentDatabase(),
            $projectDatabase->getCurrentTable()
        ));
        if ($request->isPostRequest) {

            if ($sql) {
                try {
                    $rows = $projectDatabase->exec($sql);
                    Yii::app()->user->setSQLFlash($sql);
                } catch (CDbException $e) {
                    Yii::app()->user->setErrorFlash(
                        'database',
                        'Error: :message',
                        array(':message' => nl2br(htmlspecialchars($e->getMessage())))
                    );
                }
            }
        }
        $this->renderPartial('//modules/project/database/_sql',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase,
            'sql' => $sql,
            'rows' => $rows
        ));
    }

    public function actionStructure() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $this->renderPartial('//modules/project/database/_structure',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase,
        ));
    }

    public function actionIndex() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $this->renderPartial('//modules/project/database/_index',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase,
        ));
    }

    public function actionManage() {
        $project = $this->_getProject();
        $this->renderPartial('//modules/project/database/_manage',array(
            'project' => $project
        ));
    }

    public function _getProjectDatabase(Project $project) {
        $projectDatabase = $project->projectDatabase;
        if (!$projectDatabase) {
            if (Yii::app()->user->checkAccess(PERMISSION_DATABASE_MANAGE)) {
                $this->redirect(array('action' => 'manage'));
            }
            throw new Exception('Database not configured');
        }
        $databases = $projectDatabase->getDatabases();
        $projectDatabase->connect(
            Yii::app()->request->getParam('database',reset($databases)),
            Yii::app()->request->getParam('table')
        );
        return $projectDatabase;
    }

}