<?php

/**
* This is the model class for table "page_error".
*
* The followings are the available columns in table 'page_error':
    * @property string $id
    * @property string $error_id
    * @property string $page_id
    *
    * The followings are the available model relations:
        * @property Error $error
        * @property Page $page
*/
class CPageError extends ActiveRecord {

    public function tableName()	{
        return 'page_error';
    }

    public function rules()	{
        return array(
            array('error_id, page_id', 'required'),
			array('error_id, page_id', 'length', 'max'=>10)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'error' => array(self::BELONGS_TO, 'Error', 'error_id'),
            'page' => array(self::BELONGS_TO, 'Page', 'page_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'error_id' => 'Error',
            'page_id' => 'Page',
        );
    }


}
