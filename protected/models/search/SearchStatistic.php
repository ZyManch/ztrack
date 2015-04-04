<?php

/**
* This is the model class for table "statistic".
*
* The followings are the available columns in table 'statistic':
    * @property string $id
    * @property string $company_id
    * @property string $name
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property GroupStatistic[] $groupStatistics
            * @property Company $company
            * @property StatisticPoint[] $statisticPoints
    */
class SearchStatistic extends CStatistic {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, company_id, name, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('Statistic', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
