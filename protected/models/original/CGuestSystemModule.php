<?php

/**
 * This is the model class for table "guest_system_module".
 *
 * The followings are the available columns in table 'guest_system_module':
 * @property string $id
 * @property string $system_module_id
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property SystemModule $systemModule
 */
class CGuestSystemModule extends ActiveRecord {

	public function tableName()	{
		return 'guest_system_module';
	}

	public function rules()	{
		return array(
			array('system_module_id, changed', 'required'),
			array('system_module_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, system_module_id, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'systemModule' => array(self::BELONGS_TO, 'SystemModule', 'system_module_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'system_module_id' => 'System Module',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('system_module_id',$this->system_module_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}