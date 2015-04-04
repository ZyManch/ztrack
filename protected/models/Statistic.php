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

    public function getLastPoints($count) {
        $criteria = new CDbCriteria();
        $criteria->params[':count']  = $count;
        $criteria->compare('t.statistic_id',$this->id);
        $criteria->order = 't.date ASC';
        switch ($this->interval) {
            case self::INTERVAL_MINUTE:
                $format = '%Y-%m-%d %H:%i';
                $interval = 'MINUTE';
                break;
            case self::INTERVAL_HOUR:
                $format = '%Y-%m-%d %H';
                $interval = 'HOUR';
                break;
            case self::INTERVAL_DAY:
                $format = '%Y-%m-%d';
                $interval = 'DAY';
                break;
            case self::INTERVAL_WEEK:
                $format = '%Y-%u';
                $interval = 'WEEK';
                break;
            case self::INTERVAL_MONTH:
                $format = '%Y-%m';
                $interval = 'MONTH';
                break;
            default:
                throw new Exception('Unknown interval type');
        }
        $criteria->select = array(
            sprintf('DATE_FORMAT(date,"%s") as date',$format),
            'value'
        );
        $phpFormat = str_replace('%','',$format);
        $criteria->addCondition(sprintf('date >= ADDDATE(NOW(),INTERVAL - :count MONTH)',$interval));
        $points = StatisticPoint::model()->findAll($criteria);
        $result = array();
        $now = date('Y-m-d H:i:s',Yii::app()->dateFormatter->getCurrentTimestamp());
        for ($i=-$count;$i<0;$i++) {
            $timestamp = strtotime($now.' '.$i.' '.$interval);
            $result[date($phpFormat,$timestamp)] = 0;
        }
        foreach ($points as $point) {
            $result[$point->date] = (float)$point->value;
        }
        return $result;
    }

}
