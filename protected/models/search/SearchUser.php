<?php

/**
* This is the model class for table "user".
*
* The followings are the available columns in table 'user':
    * @property string $id
    * @property string $company_id
    * @property string $email
    * @property string $password
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
    * @property Page[] $pages
    * @property Page[] $pages1
    * @property Company $company
    * @property UserAccess[] $userAccesses
    * @property UserGroup[] $userGroups
    * @property UserSystemModule[] $userSystemModules
    */
class SearchUser extends CUser {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, company_id, email, password, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('User', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
