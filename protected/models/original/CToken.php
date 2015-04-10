<?php

/**
* This is the model class for table "token".
*
* The followings are the available columns in table 'token':
    * @property string $id
    * @property string $hash
    * @property string $user_id
    * @property string $project_id
    * @property string $type
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property User $user
        * @property Project $project
*/
class CToken extends ActiveRecord {

    public function tableName()	{
        return 'token';
    }

    public function rules()	{
        return array(
            array('hash', 'required'),
			array('hash', 'length', 'max'=>64),
			array('user_id, project_id', 'length', 'max'=>11),
			array('type, status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'hash' => 'Hash',
            'user_id' => 'User',
            'project_id' => 'Project',
            'type' => 'Type',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
