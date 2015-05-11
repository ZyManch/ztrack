<?php

/**
* This is the model class for table "statistic_data_string".
*
* The followings are the available columns in table 'statistic_data_string':
*/
class StatisticDataString extends CStatisticDataString {

    public $value;

    public function rules()	{
        return array_merge(
            parent::rules(),
            array(
                array('value', 'safe')
            )
        );
    }

}
