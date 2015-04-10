<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.04.2015
 * Time: 12:01
 */
class FlotPieGraph extends FlotAbstract {
    protected $_settings = array(
        'series' =>  array(
            'pie' => array(
                'show' => true,
            )
        ),
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
            'content' => '%s <br> %y.0 (%p.0%) ',
        )
    );

    public function _render($htmlOptions) {
        $id = $htmlOptions['id'];
        $clientScript = Yii::app()->clientScript;
        $data = array();
        foreach ($this->_data as $index => $row) {
            $color = $this->_getColorByIndex($index);
            $data[] = array(
                'label' => $row->getLabel(),
                'color' => $color['bg'],
                'data' => $row->getLastValue()
            );
        }

        $clientScript->registerScript(
            'init-'.$id,
            sprintf(
                '
                var options = %s;
                var data = %s;
                $.plot($("#%s"), data, options);',
                json_encode($this->_settings),
                json_encode($data),
                $id
            ),
            CClientScript::POS_LOAD
        );
        return CHtml::tag('div',$htmlOptions,'',true);
    }
}