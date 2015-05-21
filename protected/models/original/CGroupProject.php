<?php

/**
* This is the model class for table "group_project".
*
* The followings are the available columns in table 'group_project':
    * @property string $id
    * @property string $group_id
    * @property string $project_id
    *
    * The followings are the available model relations:
        * @property Project $project
        * @property Group $group
        * @property GroupProjectModule[] $groupProjectModules
*/
class CGroupProject extends ActiveRecord {

    public function tableName()	{
        return 'group_project';
    }

    public function rules()	{
        return array(
            array('group_id, project_id', 'required'),
			array('group_id, project_id', 'length', 'max'=>10)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
            'groupProjectModules' => array(self::HAS_MANY, 'GroupProjectModule', 'group_project_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'group_id' => 'Group',
            'project_id' => 'Project',
        );
    }


}
