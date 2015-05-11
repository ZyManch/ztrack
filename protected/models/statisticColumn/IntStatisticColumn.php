<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 11:50
 */
class IntStatisticColumn extends AbstractStatisticColumn {

    public $type = self::TYPE_INT;

    public function getFormatList() {
        return array(
            'unchanged' => '',
            'count' => 'count',
            'sum' => 'sum',
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
        return 'statisticDataInts.value';
    }
}