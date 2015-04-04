<?php

/**
* This is the model class for table "group_statistic".
*
* The followings are the available columns in table 'group_statistic':
    * @property string $id
    * @property string $group_id
    * @property string $statistic_id
    *
    * The followings are the available model relations:
            * @property Group $group
            * @property Statistic $statistic
    */
class SearchGroupStatistic extends CGroupStatistic {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, group_id, statistic_id', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('statistic_id',$this->statistic_id,true);

        return new CActiveDataProvider('GroupStatistic', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
