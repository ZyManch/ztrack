<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 13:50
 */
class Constants extends CComponent {

    public function init() {
        $this->_loadConstants();
    }

    protected function _loadConstants() {
        PageType::loadConstants();
    }
}