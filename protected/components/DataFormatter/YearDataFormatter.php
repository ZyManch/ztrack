<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 16:28
 */
class YearDataFormatter extends  AbstractDataFormatter{

    public function __toString() {
        return 'DATE_FORMAT('.$this->_column.',"%Y")';
    }

    public function formatLabel($label) {
        return 'Year of '.$label;
    }
}