<?php

/**
* This is the model class for table "user".
*
* The followings are the available columns in table 'user':
    * @property string $id
    * @property string $company_id
    * @property string $login
    * @property string $username
    * @property string $email
    * @property string $password
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Message[] $messages
        * @property Page[] $pages
        * @property PageHistory[] $pageHistories
        * @property PageHistory[] $pageHistories1
        * @property Company $company
        * @property UserAccess[] $userAccesses
        * @property UserGroup[] $userGroups
        * @property UserMessage[] $userMessages
        * @property UserPage[] $userPages
        * @property UserSystemModule[] $userSystemModules
*/
class CUser extends ActiveRecord {

    public function tableName()	{
        return 'user';
    }

    public function rules()	{
        return array(
            array('company_id, login, username, email, password', 'required'),
			array('company_id', 'length', 'max'=>10),
			array('login, password', 'length', 'max'=>32),
			array('username, email', 'length', 'max'=>128),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'messages' => array(self::HAS_MANY, 'Message', 'user_id'),
            'pages' => array(self::HAS_MANY, 'Page', 'author_user_id'),
            'pageHistories' => array(self::HAS_MANY, 'PageHistory', 'assign_user_id'),
            'pageHistories1' => array(self::HAS_MANY, 'PageHistory', 'user_id'),
            'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
            'userAccesses' => array(self::HAS_MANY, 'UserAccess', 'user_id'),
            'userGroups' => array(self::HAS_MANY, 'UserGroup', 'user_id'),
            'userMessages' => array(self::HAS_MANY, 'UserMessage', 'user_id'),
            'userPages' => array(self::HAS_MANY, 'UserPage', 'user_id'),
            'userSystemModules' => array(self::HAS_MANY, 'UserSystemModule', 'user_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'company_id' => 'Company',
            'login' => 'Login',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
