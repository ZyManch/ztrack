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
                    'actions' => array('index','view'),
                    'users'=>array('*'),
                )
            ),
            parent::accessRules()
        );
    }

    public function actionIndex() {
        $this->renderPartial(
            '//modules/project/tickets/_index',
            array(
                'my_tickets_widget' => $this->_getMyTicketsWidget(),
                'second_widget' => $this->_getSecondWidget()
            )
        );
    }

    public function actionView() {
        $model = $this->_getCurrentTicket();
        $this->renderPartial(
            '//modules/project/tickets/_view',
            array(
                'model' => $model,
            )
        );
    }


    protected function  _getSecondWidget() {
        $projectId = Yii::app()->request->getParam('id');
        $widget = new LastReleaseWidgetModule();
        $widget->configure($projectId);
        if ($widget->getLastRelease()) {
            return $widget;
        }
        $widget = new TicketsWidgetModule();
        $page = new SearchPage();
        $page->project_id = Yii::app()->request->getParam('id');
        $widget->configure($page);
        return $widget;
    }


    protected function _getMyTicketsWidget() {
        $page = new SearchPage();
        $page->project_id = Yii::app()->request->getParam('id');
        $page->assign_user_id = Yii::app()->user->id;
        $widget = new TicketsWidgetModule();
        $widget->configure($page);
        return $widget;
    }

    protected function _getCurrentTicket() {
        $ticketId = Yii::app()->request->getParam('ticket_id');
        if (!$ticketId) {
            throw new Exception('Missed ticket id');
        }
        $ticket = TicketPage::model()->findByAttributes(array(
            'id'=>$ticketId,
            'project_id'=>Yii::app()->request->getParam('id')
        ));
        if (!$ticket) {
            throw new Exception('Ticket not found');
        }
        return $ticket;
    }
}