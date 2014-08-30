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
 * @property Company $company
 * @property UserAccess[] $userAccesses
 * @property UserGroup[] $userGroups
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
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'userAccesses' => array(self::HAS_MANY, 'UserAccess', 'user_id'),
			'userGroups' => array(self::HAS_MANY, 'UserGroup', 'user_id'),
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

	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}
