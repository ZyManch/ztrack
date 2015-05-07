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
class SearchUserPermission extends CUserPermission {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, user_id, permission_id', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('permission_id',$this->permission_id,true);

        return new CActiveDataProvider('UserPermission', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
