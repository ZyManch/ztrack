<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 14.03.2015
 * Time: 23:35
 */
class ProjectTicketsWidgetModule extends AbstractWidgetModule{

    protected $_projectId;
    protected $_withChild;

    public function configure($projectId = null, $withChild = false) {
        $this->_projectId = $projectId;
        $this->_withChild = $withChild;
    }

    public function draw() {
        Yii::app()->controller->renderPartial(
            '//modules/widget/_projectTickets',
            array(
                'provider' => $this->_getTicketsProvider()
            )
        );
    }


    protected function _getTicketsProvider() {
        $search = new Page('search');
        $search->page_type_id = PAGE_TYPE_TICKETS;
        $search->project_id = $this->_projectId;
        if ($this->_withChild) {
            $criteria->addCondition('parent_page_id is NULL');
        }
        return $search->search();
    }
}