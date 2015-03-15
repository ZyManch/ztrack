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

public function search() {

$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('parent_page_id',$this->parent_page_id,true);
		$criteria->compare('author_user_id',$this->author_user_id,true);
		$criteria->compare('assign_user_id',$this->assign_user_id,true);
		$criteria->compare('page_type_id',$this->page_type_id,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('progress',$this->progress);
		$criteria->compare('level_id',$this->level_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

return new CActiveDataProvider($this, array(
'criteria'=>$criteria,
'pagination'=>array('pageSize'=>40)
));
}

}
