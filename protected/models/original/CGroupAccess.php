<?php

/**
* This is the model class for table "group_access".
*
* The followings are the available columns in table 'group_access':
    * @property string $id
    * @property string $group_id
    * @property string $access_id
    * @property string $project_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Access $access
        * @property Project $project
        * @property Group $group
*/
class CGroupAccess extends ActiveRecord {

    public function tableName()	{
        return 'group_access';
    }

    public function rules()	{
        return array(
            array('group_id, access_id, project_id, changed', 'required'),
			array('group_id, access_id, project_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'access' => array(self::BELONGS_TO, 'Access', 'access_id'),
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'group_id' => 'Group',
            'access_id' => 'Access',
            'project_id' => 'Project',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
