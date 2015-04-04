<?php

/**
* This is the model class for table "group".
*
* The followings are the available columns in table 'group':
    * @property string $id
    * @property string $company_id
    * @property string $title
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Company $company
        * @property GroupProject[] $groupProjects
        * @property GroupStatistic[] $groupStatistics
        * @property UserGroup[] $userGroups
*/
class CGroup extends ActiveRecord {

    public function tableName()	{
        return 'group';
    }

    public function rules()	{
        return array(
            array('company_id, title', 'required'),
			array('company_id', 'length', 'max'=>10),
			array('title', 'length', 'max'=>32),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
            'groupProjects' => array(self::HAS_MANY, 'GroupProject', 'group_id'),
            'groupStatistics' => array(self::HAS_MANY, 'GroupStatistic', 'group_id'),
            'userGroups' => array(self::HAS_MANY, 'UserGroup', 'group_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'company_id' => 'Company',
            'title' => 'Title',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
