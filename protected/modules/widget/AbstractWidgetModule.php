<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 14.03.2015
 * Time: 23:13
 */
abstract class AbstractWidgetModule extends SystemModule {

    abstract public function getTitle();

    abstract protected function _renderWidget();

    abstract public function configure($config);

    abstract public function convertPostToConfigure($postData);


    public function renderWidget() {
        try {
            $this->_renderWidget();
        } catch (Exception $e) {
            echo CHtml::tag('div',array('class'=>'alert alert-danger'),$e->getMessage());
        }
    }

    public function renderConfigure(CActiveForm $form, $config = null) {
        Yii::app()->controller->renderPartial('//modules/widget/'.$this->name.'/_settings',array(
            'system_module'=>$this,
            'config' => $config,
            'form' => $form
        ));
    }
}