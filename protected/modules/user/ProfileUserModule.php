<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 11:10
 */
class ProfileUserModule extends AbstractUserModule {

    public function getMainMenuItems() {
        return array(
            array(
                'template' => '//modules/user/_profileMain'
            )
        );
    }

    public function getMainMenuRightItems() {
        return array(
            //array('template' => '//modules/user/_profileTop')
        );
    }
}