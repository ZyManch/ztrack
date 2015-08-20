<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 14.03.2015
 * Time: 23:13
 */
abstract class AbstractWidgetModule extends SystemModule {

    abstract function getModuleName();

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

    public function renderPartial($file,$attributes = array()) {
        if (substr($file,0,2)!='//') {
            $file = $this->getViewPath().ltrim($file,'/');
        }
        $attributes['module'] = $this;
        Yii::app()->controller->renderPartial($file,$attributes);
    }

    public function getViewPath() {
        return 'application.modules.widget.'.$this->getModuleName().'.views.';
    }
    public function renderConfigure(CActiveForm $form, $config = null) {
        $this->renderPartial('_settings',array(
            'system_module'=>$this,
            'config' => $config,
            'form' => $form
        ));
    }
}