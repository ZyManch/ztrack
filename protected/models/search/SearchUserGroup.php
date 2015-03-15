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
            * @property User $user
            * @property Group $group
    */
class SearchUserGroup extends CUserGroup {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, user_id, group_id, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('UserGroup', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
