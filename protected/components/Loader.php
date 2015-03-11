<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 13:50
 */
class Loader extends CComponent {

    public $enabled = true;

    public function init() {
        if ($this->enabled) {
            $this->_loadConstants();
        }
        $this->_loadComposer();
    }

    protected function _loadConstants() {
        PageType::loadConstants();
    }

    protected function _loadComposer() {
        spl_autoload_unregister(array('YiiBase','autoload'));
        require_once dirname(__FILE__).'/../vendor/autoload.php';
        spl_autoload_register(array('YiiBase','autoload'), false,false);
    }
}