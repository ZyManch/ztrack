<?php

/**
* This is the model class for table "user_group".
*
* The followings are the available columns in table 'user_group':
    * @property string $id
    * @property string $user_id
    * @property string $group_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Group $group
        * @property User $user
*/
class CUserGroup extends ActiveRecord {

    public function tableName()	{
        return 'user_group';
    }

    public function rules()	{
        return array(
            array('user_id, group_id, changed', 'required'),
			array('user_id, group_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'group_id' => 'Group',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
