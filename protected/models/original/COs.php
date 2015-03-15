<?php

/**
* This is the model class for table "os".
*
* The followings are the available columns in table 'os':
    * @property string $id
    * @property string $os
    * @property string $name
    * @property string $version
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Request[] $requests
*/
class COs extends ActiveRecord {

    public function tableName()	{
        return 'os';
    }

    public function rules()	{
        return array(
            array('os, changed', 'required'),
			array('os', 'length', 'max'=>255),
			array('name, version', 'length', 'max'=>32),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'requests' => array(self::HAS_MANY, 'Request', 'os_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'os' => 'Os',
            'name' => 'Name',
            'version' => 'Version',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
