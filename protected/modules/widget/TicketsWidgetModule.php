<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 14.03.2015
 * Time: 23:14
 */
class TicketsWidgetModule extends AbstractWidgetModule {

    /** @var  SearchPage */
    protected $_page;

    public function getTitle() {
        return 'Current ticket list';
    }

    public function configure($config) {
        $page = new SearchPage();
        $page->page_type_id = PAGE_TYPE_TICKETS;
        $page->attributes = $config;
        $this->_page = $page;
    }

    public function convertPostToConfigure($postData) {
        return $postData;
    }

    protected function _renderWidget() {
        try {
            Yii::app()->controller->renderPartial(
                '//modules/widget/tickets/_view',
                array(
                    'search_model' => $this->_getTicketsSearchModel()
                )
            );
        } catch (Exception $e) {
            ob_end_clean();
            throw $e;
        }
    }

    protected function _getTicketsSearchModel() {
        return $this->_page;
    }
}