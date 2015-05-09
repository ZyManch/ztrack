<?php

/**
* This is the model class for table "statistic_data_string_value".
*
* The followings are the available columns in table 'statistic_data_string_value':
    * @property string $id
    * @property string $value
    *
    * The followings are the available model relations:
        * @property StatisticDataString[] $statisticDataStrings
*/
class CStatisticDataStringValue extends ActiveRecord {

    public function tableName()	{
        return 'statistic_data_string_value';
    }

    public function rules()	{
        return array(
            array('value', 'required')        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'statisticDataStrings' => array(self::HAS_MANY, 'StatisticDataString', 'statistic_data_string_value_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'value' => 'Value',
        );
    }


}
