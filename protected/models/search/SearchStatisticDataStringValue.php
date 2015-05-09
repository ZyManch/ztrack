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
class SearchStatisticDataStringValue extends CStatisticDataStringValue {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, value', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('value',$this->value,true);

        return new CActiveDataProvider('StatisticDataStringValue', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
