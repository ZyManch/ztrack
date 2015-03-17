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
            array('name, title, description, position', 'required'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>32),
			array('title', 'length', 'max'=>64),
			array('type', 'length', 'max'=>7),
			array('installation', 'length', 'max'=>11)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
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


}
