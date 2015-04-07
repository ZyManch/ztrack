<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 06.04.2015
 * Time: 16:50
 */
class ChartBarGraph extends ChartAbstract {


    protected $_settings = array(
        'scaleBeginAtZero' => true,
        'scaleShowGridLines' => true,
        'scaleGridLineColor' => "rgba(0,0,0,.05)",
        'scaleGridLineWidth' => 1,
        'barShowStroke' => true,
        'barStrokeWidth' => 2,
        'barValueSpacing' => 5,
        'barDatasetSpacing' => 1,
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
                'highlightFill' => $color['border'],
                'highlightStroke' => $color['active'],
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
                var barData = %s;
                var barOptions = %s;
                var myNewChart = new Chart(ctx).Bar(barData, barOptions);',
                $id,
                json_encode(array('labels' => $labels,'datasets' => $datasets)),
                json_encode($this->_settings)
            ),
            CClientScript::POS_LOAD
        );

        return CHtml::tag('canvas',$htmlOptions);
    }
}