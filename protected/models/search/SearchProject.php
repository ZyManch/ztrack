<?php

/**
* This is the model class for table "project".
*
* The followings are the available columns in table 'project':
    * @property string $id
    * @property string $title
    * @property string $parent_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property GroupAccess[] $groupAccesses
            * @property Page[] $pages
            * @property Project $parent
            * @property Project[] $projects
            * @property ProjectSystemModule[] $projectSystemModules
            * @property UserAccess[] $userAccesses
    */
class SearchProject extends CProject {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, title, parent_id, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('Project', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
