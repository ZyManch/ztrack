<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 15.04.2015
 * Time: 18:27
 */
class WorldMap {

    protected $_data;

    protected $_htmlOptions = array();

    static $_isInit = false;

    public function __construct(GraphData $data) {
        $this->_data = $data;
    }

    public function setHtmlOptions($htmlOptions) {
        $this->_htmlOptions = $htmlOptions;
    }

    protected function _init() {
        if (self::$_isInit) {
            return false;
        }
        $clientScript = Yii::app()->clientScript;
        $clientScript->registerScriptFile('/js/jvectormap/jquery-jvectormap-1.2.2.min.js');
        $clientScript->registerScriptFile('/js/jvectormap/jquery-jvectormap-world-mill-en.js');
        self::$_isInit = true;
        return true;
    }

    public function __toString() {
        try {
            $this->_init();
            $clientScript = Yii::app()->clientScript;
            if (!isset($this->_htmlOptions['id'])) {
                $this->_htmlOptions['id'] = CHtml::ID_PREFIX.CHtml::$count++;
            }
            $id = $this->_htmlOptions['id'];
            $clientScript->registerScript(
                'init-map-'.$id,
                sprintf('var mapData = %s;
                $("#%s").vectorMap({
                    map: "world_mill_en",
                    backgroundColor: "transparent",
                    regionStyle: {
                    initial: {
                        fill: "#e4e4e4",
                            "fill-opacity": 1,
                            stroke: "none",
                            "stroke-width": 0,
                            "stroke-opacity": 0
                        }
                    },
                    series: {
                    regions: [{
                        values: mapData,
                            scale: ["#1ab394", "#22d6b1"],
                            normalizeFunction: "polynomial"
                        }]
                    }
                });',
                json_encode(array_map('intval',$this->_data->getData())),
                $id
            ));
            return CHtml::tag(
                'div',
                $this->_htmlOptions
            );
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}