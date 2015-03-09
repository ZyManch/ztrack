<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 10:25
 */
abstract class AbstractUserModule extends SystemModule{


    public function getMainMenuRightHtml() {
        return '';
    }

    public function getMainMenuLeftHtml() {
        return '';
    }

    public function getMainMenuItems() {
        return array();
    }

    public function save() {
        throw new Exception('Its read only property');
    }

    public function delete() {
        throw new Exception('Its read only property');
    }


}