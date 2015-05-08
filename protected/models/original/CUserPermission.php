<?php

/**
* This is the model class for table "user_permission".
*
* The followings are the available columns in table 'user_permission':
    * @property string $id
    * @property string $user_id
    * @property string $permission_id
    *
    * The followings are the available model relations:
        * @property User $user
        * @property Permission $permission
*/
class CUserPermission extends ActiveRecord {

    public function tableName()	{
        return 'user_permission';
    }

    public function rules()	{
        return array(
            array('user_id, permission_id', 'required'),
			array('user_id, permission_id', 'length', 'max'=>10)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'permission' => array(self::BELONGS_TO, 'Permission', 'permission_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'permission_id' => 'Permission',
        );
    }


}
