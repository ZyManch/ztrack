<?php

/**
* This is the model class for table "method".
*
* The followings are the available columns in table 'method':
    * @property string $id
    * @property string $title
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Request[] $requests
*/
class CMethod extends ActiveRecord {

    public function tableName()	{
        return 'method';
    }

    public function rules()	{
        return array(
            array('title', 'required'),
			array('title', 'length', 'max'=>32),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'requests' => array(self::HAS_MANY, 'Request', 'method_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
