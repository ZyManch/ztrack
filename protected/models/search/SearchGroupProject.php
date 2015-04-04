<?php

/**
* This is the model class for table "group_project".
*
* The followings are the available columns in table 'group_project':
    * @property string $id
    * @property string $group_id
    * @property string $project_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Project $project
            * @property Group $group
            * @property GroupProjectModule[] $groupProjectModules
    */
class SearchGroupProject extends CGroupProject {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, group_id, project_id, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('GroupProject', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
