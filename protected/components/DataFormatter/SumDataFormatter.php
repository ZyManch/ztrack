<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 16:28
 */
class SumDataFormatter extends  AbstractDataFormatter{

    public function __toString() {
        return 'SUM('.$this->_column.')';
    }

    public function formatLabel($label) {
        return 'Sum of '.$label;
    }
}