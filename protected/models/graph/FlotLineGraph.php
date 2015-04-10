<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.04.2015
 * Time: 12:01
 */
class FlotLineGraph extends FlotAbstract {
    protected $_settings = array(
        'series' =>  array(
            'lines' => array(
                'show' => true,
                'lineWidth' => 2,
                'fill' => true,
                'fillColor' => array(
                    'colors' => array(
                        array('opacity' => 0.0),
                        array('opacity' => 0.0)
                    )
                )
            )
        ),
        'xaxis' => array(
            'position'=>'bottom',
            'tickDecimals' => 0
        ),
        'colors' => array(),
        'grid' => array(
            'color' => "#999999",
            'hoverable' => true,
            'clickable' => true,
            'tickColor' => "#D4D4D4",
            'borderWidth' => 0
        ),
        'legend' => array(
            'show' => true
        ),
        'tooltip' => true,
        'tooltipOpts' => array(
            'content' => '%s <br> X : %x , Y : %y',
        )
    );

    public function _render($htmlOptions) {
        $id = $htmlOptions['id'];
        $clientScript = Yii::app()->clientScript;
        $data = array();
        $keys = array();
        foreach ($this->_data as $index => $row) {
            $color = $this->_getColorByIndex($index);
            $this->_settings['colors'][] = $color['bg'];
            $dataItem = array(
                'label' => $row->getLabel(),
                'data' => array()
            );
            foreach ($row->getValues() as $key => $value) {
                $dataItem['data'][] = array($key,$value);
            }
            $data[] = $dataItem;
            if (!$keys) {
                $keys = $row->getKeys();
            }
        }

        $clientScript->registerScript(
            'init-'.$id,
            sprintf(
                '
                var keys = %s;
                var options = %s;
                options.xaxis.tickFormatter = function(val, axis) {
                    return keys[val];
                };
                var data = %s;
                $.plot($("#%s"), data, options);',
                json_encode($keys),
                json_encode($this->_settings),
                json_encode($data),
                $id
            ),
            CClientScript::POS_LOAD
        );

        return CHtml::tag('div',$htmlOptions,'',true);
    }
}