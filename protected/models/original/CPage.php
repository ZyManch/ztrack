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
class CPage extends ActiveRecord {

	public function tableName()	{
		return 'page';
	}

	public function rules()	{
		return array(
			array('author_user_id, page_type_id, body, changed', 'required'),
			array('progress', 'numerical', 'integerOnly'=>true),
			array('parent_page_id, author_user_id, assign_user_id, page_type_id, project_id, level_id', 'length', 'max'=>10),
			array('url', 'length', 'max'=>64),
			array('title', 'length', 'max'=>128),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_page_id, author_user_id, assign_user_id, page_type_id, project_id, url, title, body, progress, level_id, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'level' => array(self::BELONGS_TO, 'Level', 'level_id'),
			'authorUser' => array(self::BELONGS_TO, 'User', 'author_user_id'),
			'assignUser' => array(self::BELONGS_TO, 'User', 'assign_user_id'),
			'pageType' => array(self::BELONGS_TO, 'PageType', 'page_type_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'parentPage' => array(self::BELONGS_TO, 'Page', 'parent_page_id'),
			'pages' => array(self::HAS_MANY, 'Page', 'parent_page_id'),
			'pageLabels' => array(self::HAS_MANY, 'PageLabel', 'page_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'parent_page_id' => 'Parent Page',
			'author_user_id' => 'Author User',
			'assign_user_id' => 'Assign User',
			'page_type_id' => 'Page Type',
			'project_id' => 'Project',
			'url' => 'Url',
			'title' => 'Title',
			'body' => 'Body',
			'progress' => 'Progress',
			'level_id' => 'Level',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

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
		));
	}


}
