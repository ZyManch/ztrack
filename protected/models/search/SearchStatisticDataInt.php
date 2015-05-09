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
class SearchStatisticDataInt extends CStatisticDataInt {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, statistic_column_id, statistic_point_id, value', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('statistic_column_id',$this->statistic_column_id,true);
		$criteria->compare('statistic_point_id',$this->statistic_point_id,true);
		$criteria->compare('value',$this->value,true);

        return new CActiveDataProvider('StatisticDataInt', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
