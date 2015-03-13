<?php

/**
 * This is the model class for table "user_system_module".
 *
 * The followings are the available columns in table 'user_system_module':
 * @property string $id
 * @property string $user_id
 * @property string $system_module_id
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property User $user
 * @property SystemModule $systemModule
 */
class CUserSystemModule extends ActiveRecord {

	public function tableName()	{
		return 'user_system_module';
	}

	public function rules()	{
		return array(
			array('user_id, system_module_id, changed', 'required'),
			array('user_id, system_module_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, system_module_id, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'systemModule' => array(self::BELONGS_TO, 'SystemModule', 'system_module_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'system_module_id' => 'System Module',
			'changed' => 'Changed',
		);
	}

	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('system_module_id',$this->system_module_id,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}
