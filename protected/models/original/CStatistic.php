<?php

/**
* This is the model class for table "statistic".
*
* The followings are the available columns in table 'statistic':
    * @property string $id
    * @property string $company_id
    * @property string $name
    * @property string $interval
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property GroupStatistic[] $groupStatistics
        * @property Company $company
        * @property StatisticColumn[] $statisticColumns
        * @property StatisticPoint[] $statisticPoints
*/
class CStatistic extends ActiveRecord {

    public function tableName()	{
        return 'statistic';
    }

    public function rules()	{
        return array(
            array('company_id, name', 'required'),
			array('company_id', 'length', 'max'=>10),
			array('name', 'length', 'max'=>64),
			array('interval', 'length', 'max'=>6),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'groupStatistics' => array(self::HAS_MANY, 'GroupStatistic', 'statistic_id'),
            'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
            'statisticColumns' => array(self::HAS_MANY, 'StatisticColumn', 'statistic_id'),
            'statisticPoints' => array(self::HAS_MANY, 'StatisticPoint', 'statistic_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'company_id' => 'Company',
            'name' => 'Name',
            'interval' => 'Interval',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
