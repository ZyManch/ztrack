<?php

/**
* This is the model class for table "dashboard".
*
* The followings are the available columns in table 'dashboard':
    * @property string $id
    * @property string $user_id
    * @property string $project_id
    * @property string $name
    * @property integer $position
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property User $user
        * @property Project $project
        * @property DashboardSystemModule[] $dashboardSystemModules
*/
class CDashboard extends ActiveRecord {

    public function tableName()	{
        return 'dashboard';
    }

    public function rules()	{
        return array(
            array('name, position', 'required'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('user_id, project_id', 'length', 'max'=>10),
			array('name', 'length', 'max'=>64),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
            'dashboardSystemModules' => array(self::HAS_MANY, 'DashboardSystemModule', 'dashboard_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'project_id' => 'Project',
            'name' => 'Name',
            'position' => 'Position',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
