<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 16:28
 */
class DayDataFormatter extends  AbstractDataFormatter{

    public function __toString() {
        return 'DATE_FORMAT('.$this->_column.',"%Y-%m-%d")';
    }

    public function formatLabel($label) {
        return 'Day of '.$label;
    }
}