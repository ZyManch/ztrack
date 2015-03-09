<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 12:00
 */
class TicketsProjectModule extends AbstractProjectModule {

    public function getModuleName() {
        return 'tickets';
    }

    public function getTabs() {
        return array(
            array(
                'label' => 'Tickets',
            )
        );
    }

    public function accessRules() {
        return  array_merge(
            array(
                array('allow',
                    'actions' => array('index'),
                    'users'=>array('*'),
                )
            ),
            parent::accessRules()
        );
    }

    public function actionIndex() {
        Yii::app()->controller->renderPartial(
            '//modules/project/_tickets',
            array(

            )
        );
    }

}