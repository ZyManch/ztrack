<?php

/**
* This is the model class for table "dashboard_system_module".
*
* The followings are the available columns in table 'dashboard_system_module':
*/
class DashboardSystemModule extends CDashboardSystemModule {

    const TYPE_DEFAULT = 'Default';
    const TYPE_WARNING = 'Warning';
    const TYPE_INFO = 'Info';
    const TYPE_DANGER = 'Danger';

    public function render() {
        /** @var Controller $controller */
        $controller = Yii::app()->controller;
        return $controller->renderPartial('//dashboard/module/_' . strtolower($this->type), array(
            'dashboard_system_module' => $this
        ), true);
    }

    public function __toString() {
        try {
            return $this->render();
        } catch (Exception $e) {
            return CHtml::tag('div',array('class'=>'alert alert-danger'),$e->getMessage());
        }
    }

    /**
     * @return AbstractWidgetModule
     */
    public function getSystemModule() {
        /** @var AbstractWidgetModule $module */
        $module = $this->systemModule;
        $module->configure($this->params ? json_decode($this->params, 1) : array());
        return $module;
    }

    public static function getTypeVariants() {
        return array(
            'Default' => 'Default',
            'Warning' => 'Warning',
            'Info' => 'Info',
            'Danger' => 'Danger'
        );
    }

}
