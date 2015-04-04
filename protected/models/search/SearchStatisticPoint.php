<?php

/**
* This is the model class for table "statistic_point".
*
* The followings are the available columns in table 'statistic_point':
    * @property string $id
    * @property string $statistic_id
    * @property string $date
    * @property string $value
    *
    * The followings are the available model relations:
            * @property Statistic $statistic
    */
class SearchStatisticPoint extends CStatisticPoint {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, statistic_id, date, value', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('statistic_id',$this->statistic_id,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('value',$this->value,true);

        return new CActiveDataProvider('StatisticPoint', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
