<?php

/**
* This is the model class for table "page_history".
*
* The followings are the available columns in table 'page_history':
    * @property string $id
    * @property string $previous_page_history_id
    * @property string $assign_user_id
    * @property string $page_id
    * @property string $project_id
    * @property string $title
    * @property string $body
    * @property integer $progress
    * @property string $level_id
    * @property string $status
    * @property string $created
    *
    * The followings are the available model relations:
            * @property User $assignUser
            * @property PageHistory $previousPageHistory
            * @property PageHistory[] $pageHistories
            * @property Page $page
            * @property Project $project
            * @property Level $level
    */
class SearchPageHistory extends CPageHistory {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, previous_page_history_id, assign_user_id, page_id, project_id, title, body, progress, level_id, status, created', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('previous_page_history_id',$this->previous_page_history_id,true);
		$criteria->compare('assign_user_id',$this->assign_user_id,true);
		$criteria->compare('page_id',$this->page_id,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('progress',$this->progress);
		$criteria->compare('level_id',$this->level_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created',$this->created,true);

        return new CActiveDataProvider('PageHistory', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
