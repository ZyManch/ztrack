<?php

/**
* This is the model class for table "page".
*
* The followings are the available columns in table 'page':
    * @property string $id
    * @property string $parent_page_id
    * @property string $author_user_id
    * @property string $assign_user_id
    * @property string $page_type_id
    * @property string $project_id
    * @property string $url
    * @property string $title
    * @property string $body
    * @property integer $progress
    * @property string $level_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Level $level
            * @property User $authorUser
            * @property User $assignUser
            * @property PageType $pageType
            * @property Project $project
            * @property Page $parentPage
            * @property Page[] $pages
            * @property PageLabel[] $pageLabels
    */
class SearchPage extends CPage {

    public $assign_user_id;
    public $error_id;

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, parent_page_id, author_user_id, assign_user_id, page_type_id', 'safe', 'on'=>'search'),
            array('project_id, url, title, body, progress, level_id, error_id, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

        $criteria->with = array(
            'level'
        );
		$criteria->compare('t.id',$this->id,true);
		$criteria->compare('t.parent_page_id',$this->parent_page_id);
		$criteria->compare('t.author_user_id',$this->author_user_id);
        if ($this->assign_user_id) {
            $criteria->with['userPages']=array('on'=>'userPages.is_assigned="Yes"');
            $criteria->compare('userPages.user_id', $this->assign_user_id);
        }
		$criteria->compare('t.page_type_id',$this->page_type_id);
		$criteria->compare('t.project_id',$this->project_id);
		$criteria->compare('t.url',$this->url,true);
		$criteria->compare('t.title',$this->title,true);
		$criteria->compare('t.body',$this->body,true);
		$criteria->compare('t.progress',$this->progress);
		$criteria->compare('t.level_id',$this->level_id);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.changed',$this->changed,true);
        if ($this->error_id) {
            $criteria->compare('pageErrors.error_id', $this->error_id);
            $criteria->with['pageErrors'] = array(
                'select'=>false,
                'joinType'=>'inner join',
            );
        }
        $criteria->order = 'level.weight DESC,t.changed DESC';
        $criteria->together = true;
        return new CActiveDataProvider('Page', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
