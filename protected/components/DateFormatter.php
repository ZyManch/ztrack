<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.03.2015
 * Time: 19:37
 */
class DateFormatter extends CDateFormatter {

    public function __construct() {
        parent::__construct(Yii::app()->locale);
    }

    public function diff($timestampFrom, $timestampTo = null) {
        if (!$timestampTo) {
            $timestampTo = time();
        }
        $betweenMinutes = ($timestampTo-$timestampFrom)/60;
        if ($betweenMinutes < 60) {
            return round($betweenMinutes).' минут';
        }
        $betweenHours = $betweenMinutes/60;
        if ($betweenHours < 24) {
            return round($betweenHours).' часа';
        }
        $betweenDays = $betweenHours / 24;
        if ($betweenDays < 365) {
            return round($betweenDays).' дней';
        }
        return round($betweenDays,1).' лет';
    }
}