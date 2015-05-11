<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 16:28
 */
class GteDataFilter extends AbstractDataFilter {


    function applyToQuery(CDbCommand $query, $column) {
        $key = CHtml::ID_PREFIX.CHtml::$count++;
        $query->where($column.'>=:'.$key, array(':'.$key => $this->_value));
    }
}