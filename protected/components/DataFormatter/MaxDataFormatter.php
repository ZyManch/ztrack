<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 16:28
 */
class MaxDataFormatter extends  AbstractDataFormatter{

    public function __toString() {
        return 'MAX('.$this->_column.')';
    }

    public function formatLabel($label) {
        return 'Max of '.$label;
    }
}