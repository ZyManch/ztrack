<?php

/**
* This is the model class for table "statistic_data_int".
*
* The followings are the available columns in table 'statistic_data_int':
    * @property string $id
    * @property string $statistic_column_id
    * @property string $statistic_point_id
    * @property string $value
    *
    * The followings are the available model relations:
        * @property StatisticColumn $statisticColumn
        * @property StatisticPoint $statisticPoint
*/
class CStatisticDataInt extends ActiveRecord {

    public function tableName()	{
        return 'statistic_data_int';
    }

    public function rules()	{
        return array(
            array('statistic_column_id, statistic_point_id, value', 'required'),
			array('statistic_column_id, statistic_point_id', 'length', 'max'=>10),
			array('value', 'length', 'max'=>20)        );
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
