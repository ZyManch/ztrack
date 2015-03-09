<?php

/**
 * This is the model class for table "project_system_module".
 *
 * The followings are the available columns in table 'project_system_module':
 * @property string $id
 * @property string $project_id
 * @property string $system_module_id
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property SystemModule $systemModule
 * @property Project $project
 */
class CProjectSystemModule extends ActiveRecord {

	public function tableName()	{
		return 'project_system_module';
	}

	public function rules()	{
		return array(
			array('project_id, system_module_id, changed', 'required'),
			array('project_id, system_module_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, system_module_id, status, changed', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'project_id' => 'Project',
			'system_module_id' => 'System Module',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('system_module_id',$this->system_module_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}
