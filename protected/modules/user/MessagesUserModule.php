<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 11:07
 */
class MessagesUserModule extends AbstractUserModule {

    public function getMainMenuRightHtml() {
        return Yii::app()->controller->renderPartial('//modules/user/_messages');

    }
}