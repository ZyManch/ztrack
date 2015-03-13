<?php

/**
 * This is the model class for table "system_module".
 *
 * The followings are the available columns in table 'system_module':
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $type
 * @property string $installation
 * @property integer $position
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property GuestSystemModule[] $guestSystemModules
 * @property ProjectSystemModule[] $projectSystemModules
 * @property UserSystemModule[] $userSystemModules
 */
class CSystemModule extends ActiveRecord {

	public function tableName()	{
		return 'system_module';
	}

	public function rules()	{
		return array(
			array('name, title, description, position, changed', 'required'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>32),
			array('title', 'length', 'max'=>64),
			array('type, status', 'length', 'max'=>7),
			array('installation', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, title, description, type, installation, position, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'guestSystemModules' => array(self::HAS_MANY, 'GuestSystemModule', 'system_module_id'),
			'projectSystemModules' => array(self::HAS_MANY, 'ProjectSystemModule', 'system_module_id'),
			'userSystemModules' => array(self::HAS_MANY, 'UserSystemModule', 'system_module_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'title' => 'Title',
			'description' => 'Description',
			'type' => 'Type',
			'installation' => 'Installation',
			'position' => 'Position',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('installation',$this->installation,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}
