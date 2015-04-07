<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 06.04.2015
 * Time: 16:49
 */
class ChartLineGraph extends ChartAbstract {

    protected $_settings = array(
        'scaleShowGridLines' => true,
        'scaleGridLineColor' => "rgba(0,0,0,.05)",
        'scaleGridLineWidth' => 1,
        'bezierCurve' => true,
        'bezierCurveTension' => 0.4,
        'pointDot' => true,
        'pointDotRadius' => 4,
        'pointDotStrokeWidth' => 1,
        'pointHitDetectionRadius' => 20,
        'datasetStroke' => true,
        'datasetStrokeWidth: ' => 2,
        'datasetFill' => true,
        'responsive' => true
    );

    public function _render($htmlOptions) {
        $id = $htmlOptions['id'];
        $clientScript = Yii::app()->clientScript;
        $datasets = array();
        $labels = array();
        foreach ($this->_data as $index => $row) {
            $color = $this->_getColorByIndex($index);
            $datasets[] = array(
                'label' => $row->getLabel(),
                'fillColor' => $color['bg'],
                'strokeColor' => $color['border'],
                'pointColor' => $color['point'],
                'pointStrokeColor' => '#fff',
                'pointHighlightFill' => '#fff',
                'pointHighlightStroke' => $color['active'],
                'data' => $row->getValues()
            );
            if (!$labels) {
                $labels = $row->getKeys();
            }
        }
        $clientScript->registerScript(
            'init-'.$id,
            sprintf(
                'var ctx = document.getElementById("%s").getContext("2d");
                var lineData = %s;
                var lineOptions = %s;
                var myNewChart = new Chart(ctx).Line(lineData, lineOptions);',
                $id,
                json_encode(array('labels' => $labels,'datasets' => $datasets)),
                json_encode($this->_settings)
            ),
            CClientScript::POS_LOAD
        );

        return CHtml::tag('canvas',$htmlOptions);
    }
}