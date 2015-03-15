<?php

/**
 * This is the model class for table "project_system_module".
 *
 * The followings are the available columns in table 'project_system_module':
 * @property string $id
 * @property string $project_id
 * @property string $system_module_id
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property SystemModule $systemModule
 */
class CProjectSystemModule extends ActiveRecord {

	public function tableName()	{
		return 'project_system_module';
	}

	public function rules()	{
		return array(
			array('project_id, system_module_id, changed', 'required'),
			array('project_id, system_module_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, system_module_id, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'systemModule' => array(self::BELONGS_TO, 'SystemModule', 'system_module_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'project_id' => 'Project',
			'system_module_id' => 'System Module',
			'changed' => 'Changed',
		);
	}


}
