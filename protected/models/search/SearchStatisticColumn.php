<?php

/**
* This is the model class for table "statistic_column".
*
* The followings are the available columns in table 'statistic_column':
    * @property string $id
    * @property string $statistic_id
    * @property string $name
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
class SearchStatisticColumn extends CStatisticColumn {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, statistic_id, name, description, type, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('statistic_id',$this->statistic_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('StatisticColumn', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
