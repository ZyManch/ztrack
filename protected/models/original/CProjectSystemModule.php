<?php

/**
* This is the model class for table "project_system_module".
*
* The followings are the available columns in table 'project_system_module':
    * @property string $id
    * @property string $project_id
    * @property string $system_module_id
    * @property string $params
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
            array('project_id, system_module_id', 'required'),
			array('project_id, system_module_id', 'length', 'max'=>10),
			array('params', 'safe')        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
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
            'params' => 'Params',
            'changed' => 'Changed',
        );
    }


}
