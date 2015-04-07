<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 06.04.2015
 * Time: 16:50
 */
class ChartPolarAreaGraph extends ChartAbstract {

    protected $_settings = array(
        'scaleShowLabelBackdrop' => true,
        'scaleBackdropColor' => "rgba(255,255,255,0.75)",
        'scaleBeginAtZero' => true,
        'scaleBackdropPaddingY' => 1,
        'scaleBackdropPaddingX' => 1,
        'scaleShowLine' => true,
        'segmentShowStroke' => true,
        'segmentStrokeColor' => "#fff",
        'segmentStrokeWidth' => 2,
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
                var polarData = %s;
                var polarOptions = %s;
                var myNewChart = new Chart(ctx).PolarArea(polarData, polarOptions);',
                $id,
                json_encode($datasets),
                json_encode($this->_settings)
            ),
            CClientScript::POS_LOAD
        );

        return CHtml::tag('canvas',$htmlOptions);
    }
}