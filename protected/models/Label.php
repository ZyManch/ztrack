<?php
class Label extends CLabel {

    public function getTextColor() {
        $r = hexdec(substr($this->color,0,2));
        $g = hexdec(substr($this->color,2,2));
        $b = hexdec(substr($this->color,4,2));
        $l = 0.3 * $r + 0.59 * $g + 0.11 * $b;
        if ($l > 255 * 3/2) {
            return '000000';
        }
        return 'ffffff';
    }
}