<?php

/**
 * This is the model class for table "os".
 *
 * The followings are the available columns in table 'os':
 * @property string $id
 * @property string $os
 * @property string $name
 * @property string $version
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property Request[] $requests
 */
class COs extends ActiveRecord {

	public function tableName()	{
		return 'os';
	}

	public function rules()	{
		return array(
			array('os, changed', 'required'),
			array('os', 'length', 'max'=>255),
			array('name, version', 'length', 'max'=>32),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, os, name, version, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'requests' => array(self::HAS_MANY, 'Request', 'os_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'os' => 'Os',
			'name' => 'Name',
			'version' => 'Version',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('os',$this->os,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}
