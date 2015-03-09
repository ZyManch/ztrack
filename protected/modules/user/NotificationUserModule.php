<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 11:05
 */
class NotificationUserModule extends AbstractUserModule {

    public function getMainMenuRightItems() {
        return array(
            array(
                'template' => '//modules/user/_notification'
            )
        );
    }

}