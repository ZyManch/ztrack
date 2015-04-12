<?php

/**
* This is the model class for table "browser".
*
* The followings are the available columns in table 'browser':
    * @property string $id
    * @property string $browser
    * @property string $version
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Request[] $requests
*/
class CBrowser extends ActiveRecord {

    public function tableName()	{
        return 'browser';
    }

    public function rules()	{
        return array(
            array('browser', 'required'),
			array('browser', 'length', 'max'=>255),
			array('version', 'length', 'max'=>32),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'requests' => array(self::HAS_MANY, 'Request', 'browser_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'browser' => 'Browser',
            'version' => 'Version',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
