<?php

/**
 * This is the model class for table "method".
 *
 * The followings are the available columns in table 'method':
 * @property string $id
 * @property string $title
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property Request[] $requests
 */
class CMethod extends ActiveRecord {

	public function tableName()	{
		return 'method';
	}

	public function rules()	{
		return array(
			array('title, changed', 'required'),
			array('title', 'length', 'max'=>32),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'requests' => array(self::HAS_MANY, 'Request', 'method_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}