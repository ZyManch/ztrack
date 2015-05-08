<?php

/**
* This is the model class for table "permission".
*
* The followings are the available columns in table 'permission':
    * @property string $id
    * @property string $constant
    * @property string $title
    * @property integer $group
    * @property integer $position
    * @property string $default_checked
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property SystemModule[] $systemModules
        * @property UserPermission[] $userPermissions
*/
class CPermission extends ActiveRecord {

    public function tableName()	{
        return 'permission';
    }

    public function rules()	{
        return array(
            array('constant, title, group, position', 'required'),
			array('group, position', 'numerical', 'integerOnly'=>true),
			array('constant, title', 'length', 'max'=>64),
			array('default_checked', 'length', 'max'=>3),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'systemModules' => array(self::HAS_MANY, 'SystemModule', 'permission_id'),
            'userPermissions' => array(self::HAS_MANY, 'UserPermission', 'permission_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'constant' => 'Constant',
            'title' => 'Title',
            'group' => 'Group',
            'position' => 'Position',
            'default_checked' => 'Default Checked',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
