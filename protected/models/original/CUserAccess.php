<?php

/**
* This is the model class for table "user_access".
*
* The followings are the available columns in table 'user_access':
    * @property string $id
    * @property string $user_id
    * @property string $access_id
    * @property string $project_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Project $project
        * @property User $user
        * @property Access $access
*/
class CUserAccess extends ActiveRecord {

    public function tableName()	{
        return 'user_access';
    }

    public function rules()	{
        return array(
            array('user_id, access_id, project_id, changed', 'required'),
			array('user_id, access_id, project_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'access' => array(self::BELONGS_TO, 'Access', 'access_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'access_id' => 'Access',
            'project_id' => 'Project',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
