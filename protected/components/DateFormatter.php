<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.03.2015
 * Time: 19:37
 */
class DateFormatter extends CDateFormatter {

    static $currentTimestamp;

    public function __construct() {
        parent::__construct(Yii::app()->locale);
    }

    public function diff($timestampFrom, $timestampTo = null) {
        if (!$timestampTo) {
            $timestampTo = time();
        }
        $betweenMinutes = ($timestampTo-$timestampFrom)/60;
        if ($betweenMinutes < 60) {
            return round($betweenMinutes).' minutes';
        }
        $betweenHours = $betweenMinutes/60;
        if ($betweenHours < 24) {
            return round($betweenHours).' hours';
        }
        $betweenDays = $betweenHours / 24;
        if ($betweenDays < 365) {
            return round($betweenDays).' days';
        }
        return round($betweenDays,1).' years';
    }

    public static function getCurrentTimestamp()
    {
        if (!self::$currentTimestamp) {
            $time = Yii::app()->db->createCommand('SELECT NOW()')->queryScalar();
            $timestamp = strtotime($time);
            if ($timestamp < strtotime('-1 day')) {
                $timestamp = time();
            }
            self::$currentTimestamp = $timestamp;
        }
        return self::$currentTimestamp;
    }
}