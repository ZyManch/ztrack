<?php

/**
* This is the model class for table "group_project_module".
*
* The followings are the available columns in table 'group_project_module':
    * @property string $id
    * @property string $group_project_id
    * @property string $system_module_id
    *
    * The followings are the available model relations:
        * @property GroupProject $groupProject
        * @property SystemModule $systemModule
*/
class CGroupProjectModule extends ActiveRecord {

    public function tableName()	{
        return 'group_project_module';
    }

    public function rules()	{
        return array(
            array('group_project_id, system_module_id', 'required'),
			array('group_project_id, system_module_id', 'length', 'max'=>10)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'groupProject' => array(self::BELONGS_TO, 'GroupProject', 'group_project_id'),
            'systemModule' => array(self::BELONGS_TO, 'SystemModule', 'system_module_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'group_project_id' => 'Group Project',
            'system_module_id' => 'System Module',
        );
    }


}
