<?php

/**
* This is the model class for table "editor".
*
* The followings are the available columns in table 'editor':
    * @property string $id
    * @property string $name
    * @property string $title
    * @property string $description
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Company[] $companies
*/
class CEditor extends ActiveRecord {

    public function tableName()	{
        return 'editor';
    }

    public function rules()	{
        return array(
            array('name, title, description', 'required'),
			array('name, title', 'length', 'max'=>32),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'companies' => array(self::HAS_MANY, 'Company', 'editor_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
