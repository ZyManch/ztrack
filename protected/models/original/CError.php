<?php

/**
* This is the model class for table "error".
*
* The followings are the available columns in table 'error':
    * @property string $id
    * @property string $title
    * @property string $hash
    * @property string $level_id
    * @property string $project_id
    * @property string $branch_id
    * @property string $total_count
    * @property string $trace_file
    * @property integer $trace_line
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Level $level
        * @property Project $project
        * @property Branch $branch
        * @property PageError[] $pageErrors
        * @property Request[] $requests
*/
class CError extends ActiveRecord {

    public function tableName()	{
        return 'error';
    }

    public function rules()	{
        return array(
            array('title, hash, level_id, branch_id', 'required'),
			array('trace_line', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>128),
			array('hash', 'length', 'max'=>32),
			array('level_id, project_id, branch_id, total_count', 'length', 'max'=>10),
			array('trace_file', 'length', 'max'=>200),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'level' => array(self::BELONGS_TO, 'Level', 'level_id'),
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
            'branch' => array(self::BELONGS_TO, 'Branch', 'branch_id'),
            'pageErrors' => array(self::HAS_MANY, 'PageError', 'error_id'),
            'requests' => array(self::HAS_MANY, 'Request', 'error_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'hash' => 'Hash',
            'level_id' => 'Level',
            'project_id' => 'Project',
            'branch_id' => 'Branch',
            'total_count' => 'Total Count',
            'trace_file' => 'Trace File',
            'trace_line' => 'Trace Line',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
