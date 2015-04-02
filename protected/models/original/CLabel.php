<?php

/**
* This is the model class for table "label".
*
* The followings are the available columns in table 'label':
    * @property string $id
    * @property string $company_id
    * @property string $title
    * @property string $color
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Company $company
        * @property PageLabel[] $pageLabels
*/
class CLabel extends ActiveRecord {

    public function tableName()	{
        return 'label';
    }

    public function rules()	{
        return array(
            array('company_id, title', 'required'),
			array('company_id', 'length', 'max'=>10),
			array('title', 'length', 'max'=>32),
			array('color', 'length', 'max'=>6),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
            'pageLabels' => array(self::HAS_MANY, 'PageLabel', 'label_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'company_id' => 'Company',
            'title' => 'Title',
            'color' => 'Color',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
