<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 07.04.2015
 * Time: 8:35
 */
abstract class GraphAbstract extends Graph {

    const DEFAULT_WIDTH = 200;
    const DEFAULT_HEIGHT = 200;

    /** @var GraphData[]  */
    protected $_data = array();

    protected $_settings = array();

    static $_includedAssets = array();

    protected $_colors = array(
        array('bg'=>'rgba(26,179,148,0.5)','border'=>'rgba(26,179,148,0.7)','point'=>'rgba(26,179,148,1)','active'=>'rgba(26,179,148,1)'),
        array('bg'=>'rgba(220,220,220,0.5)','border'=>'rgba(220,220,220,1)','point'=>'rgba(220,220,220,1)','active'=>'rgba(220,220,220,1)'),
    );


    protected function addSettings($settings) {
        $this->_settings = array_merge(
            $this->_settings,
            $settings
        );
    }

    public function addData(GraphData $row) {
        $this->_data[] = $row;
    }

    public function render($htmlOptions = array()) {
        if (!isset($htmlOptions['width'])) {
            $htmlOptions['width'] = self::DEFAULT_WIDTH;
        }
        if (!isset($htmlOptions['height'])) {
            $htmlOptions['height'] = self::DEFAULT_HEIGHT;
        }
        if (!isset($htmlOptions['id'])) {
            $htmlOptions['id'] = CHtml::ID_PREFIX.CHtml::$count++;
        }
        if (!$this->name) {
            throw new Exception('Use graph from BD');
        }
        if (!isset(self::$_includedAssets[$this->name])) {
            $this->_includeAssets();
            self::$_includedAssets[$this->name] = true;
        }
        return $this->_render($htmlOptions);
    }

    protected function _getColorByIndex($index) {
        return $this->_colors[$index % sizeof($this->_colors)];
    }

    abstract function _render($htmlOptions);

    protected function _includeAssets(){

    }
}