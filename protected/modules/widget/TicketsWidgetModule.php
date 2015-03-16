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

    public function configure(SearchPage $page) {
        $this->_page = $page;
    }


    public function draw() {
        Yii::app()->controller->renderPartial(
            '//modules/widget/_tickets',
            array(
                'search_model' => $this->_getTicketsSearchModel()
            )
        );
    }

    protected function _getTicketsSearchModel() {
        return $this->_page;
    }
}