<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 06.04.2015
 * Time: 16:49
 */
class NativePieGraph extends GraphAbstract {

    const COLOR_BG = '#d7d7d7';
    const COLOR_PIE = '#1ab394';

    protected $_settings = array(
        'max'=>100
    );

    protected $_width;
    protected $_height;
    protected $_value;

    public function _render($htmlOptions) {
        $this->_width = $htmlOptions['width'];
        $this->_height = $htmlOptions['height'];
        $values = $this->_data[0]->getValues();
        $this->_value = $values[0];
        if ($this->_value == $this->_settings['max']) {
            $content = $this->_circle(self::COLOR_PIE);
        } else if (!$this->_value) {
            $content = $this->_circle(self::COLOR_BG);
        } else {
            $content = $this->_circle(self::COLOR_BG).
                $this->_pie(self::COLOR_PIE);
        }
        return CHtml::tag('svg',
            $htmlOptions,
            $content

        );
    }

    protected function _circle($color) {
        $center = $this->_width/2;
        $radius = $center - 1;
        return CHtml::tag('circle',array('cx'=>$center,'cy'=>$center, 'r'=>$radius,'fill'=>$color));
    }

    protected function _pie($color) {
        $center = $this->_width/2;
        $radius = $center - 1;
        $angle  = round(360 * $this->_value / $this->_settings['max']) - 90;
        $x = cos(deg2rad($angle)) * $radius; // x of arc's end point
        $y = sin(deg2rad($angle)) * $radius; // y of arc's end point
        $ax = $center + $x; // absolute $x
        $ay = $center + $y; // absolute $y
        $adx = $center + 0; // absolute $dx
        $ady = $center  - $radius; // absolute $dy
        $laf = ($this->_value  >$this->_settings['max']/2 ? 1 : 0);
        return CHtml::tag('path',array('d'=>'M'.$center.' '.$center.' '.
            'L'.$adx.' '.$ady.' '.
            'A'.$radius.','.$radius.' 0 '.$laf.',1 '.$ax.','.$ay.' Z','fill'=>$color));
    }
}