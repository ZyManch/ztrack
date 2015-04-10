<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.04.2015
 * Time: 12:00
 */
abstract class FlotAbstract extends GraphAbstract {

    protected function _includeAssets() {
        $clientScript = Yii::app()->clientScript;
        $clientScript->registerScriptFile('/js/flot/jquery.flot.js');
        $clientScript->registerScriptFile('/js/flot/jquery.flot.resize.js');
        $clientScript->registerScriptFile('/js/flot/jquery.flot.pie.js');
        $clientScript->registerScriptFile('/js/flot/jquery.flot.tooltip.js');
    }

}