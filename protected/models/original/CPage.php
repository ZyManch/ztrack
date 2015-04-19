<?php

/**
* This is the model class for table "page".
*
* The followings are the available columns in table 'page':
    * @property string $id
    * @property string $parent_page_id
    * @property string $author_user_id
    * @property string $page_type_id
    * @property string $project_id
    * @property string $url
    * @property string $title
    * @property string $body
    * @property integer $progress
    * @property string $level_id
    * @property integer $position
    * @property string $status
    * @property string $created
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property User $authorUser
        * @property PageType $pageType
        * @property Project $project
        * @property Page $parentPage
        * @property Page[] $pages
        * @property Level $level
        * @property PageError[] $pageErrors
        * @property PageHistory[] $pageHistories
        * @property PageLabel[] $pageLabels
        * @property PageMessage[] $pageMessages
        * @property UserPage[] $userPages
*/
class CPage extends ActiveRecord {

    public function tableName()	{
        return 'page';
    }

    public function rules()	{
        return array(
            array('author_user_id, page_type_id, body', 'required'),
			array('progress, position', 'numerical', 'integerOnly'=>true),
			array('parent_page_id, author_user_id, page_type_id, project_id, level_id', 'length', 'max'=>10),
			array('url', 'length', 'max'=>64),
			array('title', 'length', 'max'=>128),
			array('status', 'length', 'max'=>7),
			array('created', 'safe')        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'authorUser' => array(self::BELONGS_TO, 'User', 'author_user_id'),
            'pageType' => array(self::BELONGS_TO, 'PageType', 'page_type_id'),
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
            'parentPage' => array(self::BELONGS_TO, 'Page', 'parent_page_id'),
            'pages' => array(self::HAS_MANY, 'Page', 'parent_page_id'),
            'level' => array(self::BELONGS_TO, 'Level', 'level_id'),
            'pageErrors' => array(self::HAS_MANY, 'PageError', 'page_id'),
            'pageHistories' => array(self::HAS_MANY, 'PageHistory', 'page_id'),
            'pageLabels' => array(self::HAS_MANY, 'PageLabel', 'page_id'),
            'pageMessages' => array(self::HAS_MANY, 'PageMessage', 'page_id'),
            'userPages' => array(self::HAS_MANY, 'UserPage', 'page_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'parent_page_id' => 'Parent Page',
            'author_user_id' => 'Author User',
            'page_type_id' => 'Page Type',
            'project_id' => 'Project',
            'url' => 'Url',
            'title' => 'Title',
            'body' => 'Body',
            'progress' => 'Progress',
            'level_id' => 'Level',
            'position' => 'Position',
            'status' => 'Status',
            'created' => 'Created',
            'changed' => 'Changed',
        );
    }


}
