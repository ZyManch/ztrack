<?php

/**
* This is the model class for table "company".
*
* The followings are the available columns in table 'company':
    * @property string $id
    * @property string $title
    * @property string $editor_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Branch[] $branches
        * @property Editor $editor
        * @property Group[] $groups
        * @property Label[] $labels
        * @property Level[] $levels
        * @property Project[] $projects
        * @property Server[] $servers
        * @property Statistic[] $statistics
        * @property User[] $users
*/
class CCompany extends ActiveRecord {

    public function tableName()	{
        return 'company';
    }

    public function rules()	{
        return array(
            array('title, editor_id', 'required'),
			array('title', 'length', 'max'=>64),
			array('editor_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'branches' => array(self::HAS_MANY, 'Branch', 'company_id'),
            'editor' => array(self::BELONGS_TO, 'Editor', 'editor_id'),
            'groups' => array(self::HAS_MANY, 'Group', 'company_id'),
            'labels' => array(self::HAS_MANY, 'Label', 'company_id'),
            'levels' => array(self::HAS_MANY, 'Level', 'company_id'),
            'projects' => array(self::HAS_MANY, 'Project', 'company_id'),
            'servers' => array(self::HAS_MANY, 'Server', 'company_id'),
            'statistics' => array(self::HAS_MANY, 'Statistic', 'company_id'),
            'users' => array(self::HAS_MANY, 'User', 'company_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'editor_id' => 'Editor',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
