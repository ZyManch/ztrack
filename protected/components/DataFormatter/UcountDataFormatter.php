<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 16:28
 */
class CountDataFormatter extends  AbstractDataFormatter{

    public function __toString() {
        return 'COUNT(DISTINCT '.$this->_column.')';
    }
}