<?php

/**
* This is the model class for table "page_history".
*
* The followings are the available columns in table 'page_history':
    * @property string $id
    * @property string $user_id
    * @property string $previous_page_history_id
    * @property string $assign_user_id
    * @property string $page_id
    * @property string $project_id
    * @property string $title
    * @property string $body
    * @property integer $progress
    * @property string $level_id
    * @property string $status
    * @property string $created
    *
    * The followings are the available model relations:
        * @property PageHistory $previousPageHistory
        * @property PageHistory[] $pageHistories
        * @property Page $page
        * @property Project $project
        * @property Level $level
        * @property User $assignUser
        * @property User $user
*/
class CPageHistory extends ActiveRecord {

    public function tableName()	{
        return 'page_history';
    }

    public function rules()	{
        return array(
            array('user_id, body', 'required'),
			array('progress', 'numerical', 'integerOnly'=>true),
			array('user_id, previous_page_history_id, assign_user_id, page_id, project_id, level_id', 'length', 'max'=>10),
			array('title', 'length', 'max'=>128),
			array('status', 'length', 'max'=>7),
			array('created', 'safe')        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'previousPageHistory' => array(self::BELONGS_TO, 'PageHistory', 'previous_page_history_id'),
            'pageHistories' => array(self::HAS_MANY, 'PageHistory', 'previous_page_history_id'),
            'page' => array(self::BELONGS_TO, 'Page', 'page_id'),
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
            'level' => array(self::BELONGS_TO, 'Level', 'level_id'),
            'assignUser' => array(self::BELONGS_TO, 'User', 'assign_user_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'previous_page_history_id' => 'Previous Page History',
            'assign_user_id' => 'Assign User',
            'page_id' => 'Page',
            'project_id' => 'Project',
            'title' => 'Title',
            'body' => 'Body',
            'progress' => 'Progress',
            'level_id' => 'Level',
            'status' => 'Status',
            'created' => 'Created',
        );
    }


}
