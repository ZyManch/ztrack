<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 16:28
 */
class MinDataFormatter extends  AbstractDataFormatter{

    public function __toString() {
        return 'MIN('.$this->_column.')';
    }

    public function formatLabel($label) {
        return 'Min of '.$label;
    }
}