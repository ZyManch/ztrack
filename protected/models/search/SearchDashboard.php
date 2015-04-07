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
class SearchDashboard extends CDashboard {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, user_id, project_id, name, position, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('Dashboard', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
