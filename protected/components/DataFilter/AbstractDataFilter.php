<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 16:28
 */
abstract class AbstractDataFilter {

    protected $_value;


    public function __construct($value) {
        $this->_value = $value;
    }

    abstract function applyToQuery(CDbCommand $query, $column);
}