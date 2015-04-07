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
        * @property Dashboard[] $dashboards
        * @property GroupAccess[] $groupAccesses
        * @property Page[] $pages
        * @property PageHistory[] $pageHistories
        * @property Project $parent
        * @property Project[] $projects
        * @property ProjectSystemModule[] $projectSystemModules
*/
class CProject extends ActiveRecord {

    public function tableName()	{
        return 'project';
    }

    public function rules()	{
        return array(
            array('title', 'required'),
			array('title', 'length', 'max'=>64),
			array('parent_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'dashboards' => array(self::HAS_MANY, 'Dashboard', 'project_id'),
            'groupProjects' => array(self::HAS_MANY, 'GroupProject', 'project_id'),
            'pages' => array(self::HAS_MANY, 'Page', 'project_id'),
            'pageHistories' => array(self::HAS_MANY, 'PageHistory', 'project_id'),
            'parent' => array(self::BELONGS_TO, 'Project', 'parent_id'),
            'projects' => array(self::HAS_MANY, 'Project', 'parent_id'),
            'projectSystemModules' => array(self::HAS_MANY, 'ProjectSystemModule', 'project_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'parent_id' => 'Parent',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
