<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 14.03.2015
 * Time: 23:13
 */
abstract class AbstractWidgetModule extends SystemModule {

    abstract public function getTitle();

    abstract public function renderWidget();

    abstract public function configure($config);

    abstract public function convertPostToConfigure($postData);

    public function renderConfigure(CActiveForm $form, $config = null) {
        Yii::app()->controller->renderPartial('//modules/widget/'.$this->name.'/_settings',array(
            'system_module'=>$this,
            'config' => $config,
            'form' => $form
        ));
    }
}