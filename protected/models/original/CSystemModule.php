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
    * @property string $permission_id
    * @property integer $position
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property DashboardSystemModule[] $dashboardSystemModules
        * @property GroupProjectModule[] $groupProjectModules
        * @property GuestSystemModule[] $guestSystemModules
        * @property ProjectSystemModule[] $projectSystemModules
        * @property Permission $permission
        * @property UserSystemModule[] $userSystemModules
*/
class CSystemModule extends ActiveRecord {

    public function tableName()	{
        return 'system_module';
    }

    public function rules()	{
        return array(
            array('name, title, description, position', 'required'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>32),
			array('title', 'length', 'max'=>64),
			array('type, status', 'length', 'max'=>7),
			array('installation', 'length', 'max'=>11),
			array('permission_id', 'length', 'max'=>10)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'dashboardSystemModules' => array(self::HAS_MANY, 'DashboardSystemModule', 'system_module_id'),
            'groupProjectModules' => array(self::HAS_MANY, 'GroupProjectModule', 'system_module_id'),
            'guestSystemModules' => array(self::HAS_MANY, 'GuestSystemModule', 'system_module_id'),
            'projectSystemModules' => array(self::HAS_MANY, 'ProjectSystemModule', 'system_module_id'),
            'permission' => array(self::BELONGS_TO, 'Permission', 'permission_id'),
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
            'permission_id' => 'Permission',
            'position' => 'Position',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
