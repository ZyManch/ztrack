<?php

/**
* This is the model class for table "statistic".
*
* The followings are the available columns in table 'statistic':
*/
class Statistic extends CStatistic {

    const INTERVAL_MINUTE = 'Minute';
    const INTERVAL_HOUR = 'Hour';
    const INTERVAL_DAY = 'Day';
    const INTERVAL_WEEK = 'Week';
    const INTERVAL_MONTH = 'Month';

    public function _extendedRelations() {
        return array(
            'statisticColumns' => array(self::HAS_MANY, 'StatisticColumn', 'statistic_id','index'=>'id'),
        );
    }

}
