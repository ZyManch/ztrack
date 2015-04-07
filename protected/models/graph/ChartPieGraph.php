<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 06.04.2015
 * Time: 16:50
 */
class ChartPieGraph extends ChartAbstract {

    protected $_settings = array(
        'segmentShowStroke' => true,
        'segmentStrokeColor' => "#fff",
        'segmentStrokeWidth' => 2,
        'percentageInnerCutout' => 45, // This is 0 for Pie charts
        'animationSteps' => 100,
        'animationEasing' => "easeOutBounce",
        'animateRotate' => true,
        'animateScale' => false,
        'responsive' => true,
    );


    public function _render($htmlOptions) {
        $id = $htmlOptions['id'];
        $clientScript = Yii::app()->clientScript;
        $datasets = array();
        foreach ($this->_data as $index => $row) {
            $color = $this->_getColorByIndex($index);
            $values = $row->getValues();
            $datasets[] = array(
                'label' => $row->getLabel(),
                'value' => array_pop($values),
                'color' => $color['bg'],
                'highlight' => $color['border'],
            );
        }
        $clientScript->registerScript(
            'init-'.$id,
            sprintf(
                'var ctx = document.getElementById("%s").getContext("2d");
                var doughnutData = %s;
                var doughnutOptions = %s;
                var myNewChart = new Chart(ctx).Doughnut(doughnutData, doughnutOptions);',
                $id,
                json_encode($datasets),
                json_encode($this->_settings)
            ),
            CClientScript::POS_LOAD
        );

        return CHtml::tag('canvas',$htmlOptions);
    }
}