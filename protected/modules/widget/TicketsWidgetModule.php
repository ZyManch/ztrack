<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 14.03.2015
 * Time: 23:14
 */
class TicketsWidgetModule extends AbstractWidgetModule {

    /** @var  SearchPage */
    protected $_page;

    public function getTitle() {
        return 'Текущий список задач';
    }

    public function configure($config) {
        $page = new SearchPage();
        $page->page_type_id = PAGE_TYPE_TICKETS;
        $page->attributes = $config;
        $this->_page = $page;
    }


    public function renderWidget() {
        Yii::app()->controller->renderPartial(
            '//modules/widget/tickets/_view',
            array(
                'search_model' => $this->_getTicketsSearchModel()
            )
        );
    }

    protected function _getTicketsSearchModel() {
        return $this->_page;
    }
}