<?php

/**
* This is the model class for table "statistic_point".
*
* The followings are the available columns in table 'statistic_point':
    * @property string $id
    * @property string $statistic_id
    *
    * The followings are the available model relations:
        * @property StatisticDataDate[] $statisticDataDates
        * @property StatisticDataFloat[] $statisticDataFloats
        * @property StatisticDataInt[] $statisticDataInts
        * @property StatisticDataString[] $statisticDataStrings
        * @property Statistic $statistic
*/
class CStatisticPoint extends ActiveRecord {

    public function tableName()	{
        return 'statistic_point';
    }

    public function rules()	{
        return array(
            array('statistic_id', 'required'),
			array('statistic_id', 'length', 'max'=>10)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'statisticDataDates' => array(self::HAS_MANY, 'StatisticDataDate', 'statistic_point_id'),
            'statisticDataFloats' => array(self::HAS_MANY, 'StatisticDataFloat', 'statistic_point_id'),
            'statisticDataInts' => array(self::HAS_MANY, 'StatisticDataInt', 'statistic_point_id'),
            'statisticDataStrings' => array(self::HAS_MANY, 'StatisticDataString', 'statistic_point_id'),
            'statistic' => array(self::BELONGS_TO, 'Statistic', 'statistic_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'statistic_id' => 'Statistic',
        );
    }


}
