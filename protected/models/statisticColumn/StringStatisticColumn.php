<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 11:50
 */
class StringStatisticColumn extends AbstractStatisticColumn {

    public $type = self::TYPE_STRING;

    public function getFormatList() {
        return array(
            'unchanged' => '',
            'count' => 'count'
        );
    }

    public function getFilterList() {
        return array(
            'eq' => 'equal',
            'neq' => 'not equal',
        );
    }

    public function getCompareRelationName() {
        return 'statisticDataStringValue.value';
    }

}