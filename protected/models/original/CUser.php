<?php

/**
* This is the model class for table "user".
*
* The followings are the available columns in table 'user':
    * @property string $id
    * @property string $company_id
    * @property string $login
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
class CUser extends ActiveRecord {

public function tableName()	{
return 'user';
}

public function rules()	{
return array(
    array('company_id, login, email, password, changed', 'required'),
    array('company_id', 'length', 'max'=>10),
    array('login, password', 'length', 'max'=>32),
    array('email', 'length', 'max'=>128),
    array('status', 'length', 'max'=>7),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
array('id, company_id, login, email, password, status, changed', 'safe', 'on'=>'search'),
);
}

/**
* @return array relational rules.
*/
protected function _baseRelations()	{
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
return array(
    'pages' => array(self::HAS_MANY, 'Page', 'author_user_id'),
    'pages1' => array(self::HAS_MANY, 'Page', 'assign_user_id'),
    'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
    'userAccesses' => array(self::HAS_MANY, 'UserAccess', 'user_id'),
    'userGroups' => array(self::HAS_MANY, 'UserGroup', 'user_id'),
    'userSystemModules' => array(self::HAS_MANY, 'UserSystemModule', 'user_id'),
);
}

public function attributeLabels() {
return array(
    'id' => 'ID',
    'company_id' => 'Company',
    'login' => 'Login',
    'email' => 'Email',
    'password' => 'Password',
    'status' => 'Status',
    'changed' => 'Changed',
);
}


}
