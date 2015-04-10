<?php

/**
* This is the model class for table "dashboard_system_module".
*
* The followings are the available columns in table 'dashboard_system_module':
    * @property string $id
    * @property string $dashboard_id
    * @property string $system_module_id
    * @property string $type
    * @property string $title
    * @property integer $rows
    * @property string $params
    * @property string $position
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Dashboard $dashboard
        * @property SystemModule $systemModule
*/
class CDashboardSystemModule extends ActiveRecord {

    public function tableName()	{
        return 'dashboard_system_module';
    }

    public function rules()	{
        return array(
            array('dashboard_id, system_module_id, title, position', 'required'),
			array('rows', 'numerical', 'integerOnly'=>true),
			array('dashboard_id, system_module_id, position', 'length', 'max'=>10),
			array('type, status', 'length', 'max'=>7),
			array('title', 'length', 'max'=>64),
			array('params', 'safe')        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'dashboard' => array(self::BELONGS_TO, 'Dashboard', 'dashboard_id'),
            'systemModule' => array(self::BELONGS_TO, 'SystemModule', 'system_module_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'dashboard_id' => 'Dashboard',
            'system_module_id' => 'System Module',
            'type' => 'Type',
            'title' => 'Title',
            'rows' => 'Rows',
            'params' => 'Params',
            'position' => 'Position',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
