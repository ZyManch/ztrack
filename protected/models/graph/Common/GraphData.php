<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 07.04.2015
 * Time: 8:31
 */
class GraphData  {

    protected $_label;
    protected $_data;

    public function __construct($label, $data = array()) {
        $this->_label = $label;
        $this->_data = $data;
    }

    public function addDataRow($key, $value) {
        $this->_data[$key]=$value;
    }

    public function getLabel() {
        return $this->_label;
    }

    public function getValues() {
        return array_values($this->_data);
    }

    public function getLastValue() {
        $values = $this->getValues();
        return array_pop($values);
    }

    public function getData() {
        return $this->_data;
    }

    public function getKeys() {
        return array_keys($this->_data);
    }
}