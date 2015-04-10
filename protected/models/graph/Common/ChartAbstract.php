<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 07.04.2015
 * Time: 8:38
 */
abstract class ChartAbstract extends GraphAbstract {

    protected function _includeAssets() {
        $clientScript = Yii::app()->clientScript;
        $clientScript->registerScriptFile('/js/Chart.min.js');
    }

    public function render($htmlOptions = array()) {
        $htmlOptions['height'] = 100;
        return parent::render($htmlOptions);
    }
}