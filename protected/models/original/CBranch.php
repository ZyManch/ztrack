<?php

/**
* This is the model class for table "branch".
*
* The followings are the available columns in table 'branch':
    * @property string $id
    * @property string $title
    * @property string $company_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Company $company
        * @property Error[] $errors
*/
class CBranch extends ActiveRecord {

    public function tableName()	{
        return 'branch';
    }

    public function rules()	{
        return array(
            array('title', 'required'),
			array('title', 'length', 'max'=>32),
			array('company_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
            'errors' => array(self::HAS_MANY, 'Error', 'branch_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'company_id' => 'Company',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
