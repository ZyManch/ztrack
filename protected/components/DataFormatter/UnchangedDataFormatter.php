<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 16:28
 */
class UnchangedDataFormatter extends  AbstractDataFormatter{

    public function __toString() {
        return $this->_column;
    }

    public function formatLabel($label) {
        return $label;
    }
}