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
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Dashboard $dashboard
            * @property SystemModule $systemModule
    */
class SearchDashboardSystemModule extends CDashboardSystemModule {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, dashboard_id, system_module_id, type, title, rows, params, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('dashboard_id',$this->dashboard_id,true);
		$criteria->compare('system_module_id',$this->system_module_id,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('rows',$this->rows);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('DashboardSystemModule', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
