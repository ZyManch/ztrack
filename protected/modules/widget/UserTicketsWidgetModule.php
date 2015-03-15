<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 14.03.2015
 * Time: 23:14
 */
class UserTicketsWidgetModule extends AbstractWidgetModule {

    protected $_userIds;
    protected $_projectId;

    public function configure($userIds, $projectId = null) {
        $this->_userIds = $userIds;
        $this->_projectId = $projectId;
    }


    public function draw() {
        Yii::app()->controller->renderPartial(
            '//modules/widget/_userTickets',
            array(
                'provider' => $this->_getTicketsProvider()
            )
        );
    }

    protected function _getTicketsProvider() {
        $search = new Page('search');
        $search->page_type_id = PAGE_TYPE_TICKETS;
        $search->project_id = $this->_projectId;
        $search->assign_user_id = $this->_userIds;
        return $search->search();
    }
}