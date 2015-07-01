<?php

/**
* This is the model class for table "environment".
*
* The followings are the available columns in table 'environment':
    * @property string $id
    * @property string $title
    * @property string $company_id
    * @property string $status
    *
    * The followings are the available model relations:
        * @property Company $company
        * @property Error[] $errors
        * @property ProjectDatabase[] $projectDatabases
*/
class CEnvironment extends ActiveRecord {

    public function tableName()	{
        return 'environment';
    }

    public function rules()	{
        return array(
            array('title, company_id', 'required'),
			array('title', 'length', 'max'=>64),
			array('company_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
            'errors' => array(self::HAS_MANY, 'Error', 'environment_id'),
            'projectDatabases' => array(self::HAS_MANY, 'ProjectDatabase', 'environment_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'company_id' => 'Company',
            'status' => 'Status',
        );
    }


}
