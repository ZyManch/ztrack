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
class CStatisticPoint extends ActiveRecord {

    public function tableName()	{
        return 'statistic_point';
    }

    public function rules()	{
        return array(
            array('statistic_id, date, value', 'required'),
			array('statistic_id', 'length', 'max'=>10),
			array('value', 'length', 'max'=>12)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'statistic' => array(self::BELONGS_TO, 'Statistic', 'statistic_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'statistic_id' => 'Statistic',
            'date' => 'Date',
            'value' => 'Value',
        );
    }


}
