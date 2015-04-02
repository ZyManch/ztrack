<?php

/**
* This is the model class for table "server".
*
* The followings are the available columns in table 'server':
    * @property string $id
    * @property string $title
    * @property string $company_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Request[] $requests
        * @property Company $company
*/
class CServer extends ActiveRecord {

    public function tableName()	{
        return 'server';
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
            'requests' => array(self::HAS_MANY, 'Request', 'server_id'),
            'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
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
