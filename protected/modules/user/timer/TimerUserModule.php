<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 11:03
 */
class TimerUserModule extends AbstractUserModule {

    public function getMainMenuRightItems() {
        return array(
            array(
                'template' => 'application.modules.user.timer.views._timer'
            )
        );

    }
}