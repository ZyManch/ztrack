<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 06.04.2015
 * Time: 16:51
 */
class ChartRadarGraph extends ChartAbstract {

    protected $_settings = array(
        'scaleShowLine' => true,
        'angleShowLineOut' => true,
        'scaleShowLabels' => false,
        'scaleBeginAtZero' => true,
        'angleLineColor' => "rgba(0,0,0,.1)",
        'angleLineWidth' => 1,
        'pointLabelFontFamily' => "'Arial'",
        'pointLabelFontStyle' => "normal",
        'pointLabelFontSize' => 10,
        'pointLabelFontColor' => "#666",
        'pointDot' => true,
        'pointDotRadius' => 3,
        'pointDotStrokeWidth' => 1,
        'pointHitDetectionRadius' => 20,
        'datasetStroke' => true,
        'datasetStrokeWidth' => 2,
        'datasetFill' => true,
        'responsive' => true,
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
                var radarData = %s;
                var radarOptions = %s;
                var myNewChart = new Chart(ctx).Radar(radarData, radarOptions);',
                $id,
                json_encode(array('labels' => $labels,'datasets' => $datasets)),
                json_encode($this->_settings)
            ),
            CClientScript::POS_LOAD
        );

        return CHtml::tag('canvas',$htmlOptions);
    }
}