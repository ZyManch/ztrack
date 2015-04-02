<?php

/**
* This is the model class for table "page_type".
*
* The followings are the available columns in table 'page_type':
    * @property string $id
    * @property string $constant
    * @property string $title
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Page[] $pages
*/
class CPageType extends ActiveRecord {

    public function tableName()	{
        return 'page_type';
    }

    public function rules()	{
        return array(
            array('constant, title', 'required'),
			array('constant, title', 'length', 'max'=>64),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'pages' => array(self::HAS_MANY, 'Page', 'page_type_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'constant' => 'Constant',
            'title' => 'Title',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
