<?php

/**
* This is the model class for table "statistic_column".
*
* The followings are the available columns in table 'statistic_column':
    * @property string $id
    * @property string $statistic_id
    * @property string $name
    * @property string $label
    * @property string $description
    * @property string $type
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Statistic $statistic
        * @property StatisticDataDate[] $statisticDataDates
        * @property StatisticDataFloat[] $statisticDataFloats
        * @property StatisticDataInt[] $statisticDataInts
        * @property StatisticDataString[] $statisticDataStrings
*/
class CStatisticColumn extends ActiveRecord {

    public function tableName()	{
        return 'statistic_column';
    }

    public function rules()	{
        return array(
            array('statistic_id, name, label, type', 'required'),
			array('statistic_id', 'length', 'max'=>10),
			array('name, label', 'length', 'max'=>64),
			array('type', 'length', 'max'=>6),
			array('status', 'length', 'max'=>7),
			array('description', 'safe')        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'statistic' => array(self::BELONGS_TO, 'Statistic', 'statistic_id'),
            'statisticDataDates' => array(self::HAS_MANY, 'StatisticDataDate', 'statistic_column_id'),
            'statisticDataFloats' => array(self::HAS_MANY, 'StatisticDataFloat', 'statistic_column_id'),
            'statisticDataInts' => array(self::HAS_MANY, 'StatisticDataInt', 'statistic_column_id'),
            'statisticDataStrings' => array(self::HAS_MANY, 'StatisticDataString', 'statistic_column_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'statistic_id' => 'Statistic',
            'name' => 'Name',
            'label' => 'Label',
            'description' => 'Description',
            'type' => 'Type',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
