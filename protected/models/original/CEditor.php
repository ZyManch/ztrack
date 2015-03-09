<?php

/**
 * This is the model class for table "editor".
 *
 * The followings are the available columns in table 'editor':
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property Company[] $companies
 */
class CEditor extends ActiveRecord {

	public function tableName()	{
		return 'editor';
	}

	public function rules()	{
		return array(
			array('name, title, description, changed', 'required'),
			array('name, title', 'length', 'max'=>32),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, title, description, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'companies' => array(self::HAS_MANY, 'Company', 'editor_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'title' => 'Title',
			'description' => 'Description',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}
