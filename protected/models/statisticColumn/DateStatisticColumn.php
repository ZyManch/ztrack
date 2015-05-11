<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 11:50
 */
class DateStatisticColumn extends AbstractStatisticColumn {

    public $type = self::TYPE_DATE;

    public function getFormatList() {
        return array(
            'unchanged' => '',
            'hour' => 'hour',
            'day' => 'day',
            'month' => 'month',
            'year' => 'year',
            'count' => 'count',
            'min' => 'min',
            'max' => 'max',
            'avg' => 'avg',
        );
    }

    public function getFilterList() {
        return array(
            'eq' => 'equal',
            'neq' => 'not equal',
            'lt' => 'less',
            'gt' => 'greater',
        );
    }


    public function getCompareRelationName() {
        return 'statisticDataDates.value';
    }

}