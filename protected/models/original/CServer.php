<?php

/**
 * This is the model class for table "server".
 *
 * The followings are the available columns in table 'server':
 * @property string $id
 * @property string $title
 * @property string $company_id
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property Request[] $requests
 * @property Company $company
 */
class CServer extends ActiveRecord {

	public function tableName()	{
		return 'server';
	}

	public function rules()	{
		return array(
			array('title, company_id, changed', 'required'),
			array('title', 'length', 'max'=>64),
			array('company_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, company_id, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'requests' => array(self::HAS_MANY, 'Request', 'server_id'),
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'company_id' => 'Company',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}