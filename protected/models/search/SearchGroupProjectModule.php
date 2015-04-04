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
class SearchGroupProjectModule extends CGroupProjectModule {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, group_project_id, system_module_id', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('group_project_id',$this->group_project_id,true);
		$criteria->compare('system_module_id',$this->system_module_id,true);

        return new CActiveDataProvider('GroupProjectModule', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
