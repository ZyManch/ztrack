<?php

/**
* This is the model class for table "country".
*
* The followings are the available columns in table 'country':
    * @property string $id
    * @property string $code
    * @property string $name
    * @property string $region
    *
    * The followings are the available model relations:
        * @property Request[] $requests
*/
class CCountry extends ActiveRecord {

    public function tableName()	{
        return 'country';
    }

    public function rules()	{
        return array(
            array('code, name', 'required'),
			array('code', 'length', 'max'=>3),
			array('name', 'length', 'max'=>50),
			array('region', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'requests' => array(self::HAS_MANY, 'Request', 'country_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'region' => 'Region',
        );
    }


}
