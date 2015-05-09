<?php

/**
* This is the model class for table "statistic_data_float".
*
* The followings are the available columns in table 'statistic_data_float':
    * @property string $id
    * @property string $statistic_column_id
    * @property string $statistic_point_id
    * @property double $value
    *
    * The followings are the available model relations:
        * @property StatisticColumn $statisticColumn
        * @property StatisticPoint $statisticPoint
*/
class CStatisticDataFloat extends ActiveRecord {

    public function tableName()	{
        return 'statistic_data_float';
    }

    public function rules()	{
        return array(
            array('statistic_column_id, statistic_point_id, value', 'required'),
			array('value', 'numerical'),
			array('statistic_column_id, statistic_point_id', 'length', 'max'=>10)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'statisticColumn' => array(self::BELONGS_TO, 'StatisticColumn', 'statistic_column_id'),
            'statisticPoint' => array(self::BELONGS_TO, 'StatisticPoint', 'statistic_point_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'statistic_column_id' => 'Statistic Column',
            'statistic_point_id' => 'Statistic Point',
            'value' => 'Value',
        );
    }


}
