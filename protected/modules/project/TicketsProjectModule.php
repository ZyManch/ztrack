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
                'tickets_all_provider' => $this->_getAllTicketsProvider(),
                'tickets_my_provider' => $this->_getMyTicketsProvider(),
            )
        );
    }

    protected function _getAllTicketsProvider() {
        $projectId = Yii::app()->request->getParam('id');
        $search = new Page('search');
        $search->page_type_id = PAGE_TYPE_TICKETS;
        $search->project_id = $projectId;
        return $search->search();
    }

    protected function _getMyTicketsProvider() {
        $projectId = Yii::app()->request->getParam('id');
        $search = new Page('search');
        $search->page_type_id = PAGE_TYPE_TICKETS;
        $search->project_id = $projectId;
        $search->assign_user_id = Yii::app()->user->id;
        return $search->search();
    }

}