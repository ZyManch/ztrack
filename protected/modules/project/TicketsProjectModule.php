<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 12:00
 */
class TicketsProjectModule extends AbstractProjectModule {

    public function getTabs() {
        return array(
            array(
                'label' => 'Tickets',
                'module' => 'tickets'
            )
        );
    }

    public function accessRules() {
        return  array_merge(
            array(
                array('allow',
                    'actions' => array('tickets'),
                    'users'=>array('*'),
                )
            ),
            parent::accessRules()
        );
    }

    public function actionTickets() {
        Yii::app()->controller->renderPartial(
            '//modules/project/_tickets',
            array(

            )
        );
    }

}