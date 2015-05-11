<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 16:28
 */
abstract class AbstractDataFormatter {

    protected $_column;

    public function __construct($column) {
        $this->_column = $column;
    }

    abstract function formatLabel($label);

    abstract function __toString();
}