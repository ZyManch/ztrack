<?php

/**
* This is the model class for table "statistic_data_string".
*
* The followings are the available columns in table 'statistic_data_string':
    * @property string $id
    * @property string $statistic_column_id
    * @property string $statistic_point_id
    * @property string $statistic_data_string_value_id
    *
    * The followings are the available model relations:
        * @property StatisticColumn $statisticColumn
        * @property StatisticPoint $statisticPoint
        * @property StatisticDataStringValue $statisticDataStringValue
*/
class CStatisticDataString extends ActiveRecord {

    public function tableName()	{
        return 'statistic_data_string';
    }

    public function rules()	{
        return array(
            array('statistic_column_id, statistic_point_id, statistic_data_string_value_id', 'required'),
			array('statistic_column_id, statistic_point_id, statistic_data_string_value_id', 'length', 'max'=>10)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'statisticColumn' => array(self::BELONGS_TO, 'StatisticColumn', 'statistic_column_id'),
            'statisticPoint' => array(self::BELONGS_TO, 'StatisticPoint', 'statistic_point_id'),
            'statisticDataStringValue' => array(self::BELONGS_TO, 'StatisticDataStringValue', 'statistic_data_string_value_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'statistic_column_id' => 'Statistic Column',
            'statistic_point_id' => 'Statistic Point',
            'statistic_data_string_value_id' => 'Statistic Data String Value',
        );
    }


}
