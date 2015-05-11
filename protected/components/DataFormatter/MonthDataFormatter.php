<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 16:28
 */
class MonthDataFormatter extends  AbstractDataFormatter{

    public function __toString() {
        return 'DATE_FORMAT('.$this->_column.',"%Y %M")';
    }

    public function formatLabel($label) {
        return 'Month of '.$label;
    }
}