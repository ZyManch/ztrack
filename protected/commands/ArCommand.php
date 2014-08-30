<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 28.06.14
 * Time: 21:27
 */
class ArCommand extends CConsoleCommand {


    public function run($args) {
        Yii::import('system.gii.*',true);
        Yii::import('system.gii.controllers.*',true);
        Yii::import('system.gii.generators.model.*',true);
        $tables = $this->_getTables();
        $model = new ModelCode();
        $templatePath = Yii::getPathOfAlias('system.gii.generators.model.templates.default');
        Yii::app()->setComponent('controller',array(
            'class'=>'CCodeGenerator',
            'templates'=>array('default' => $templatePath),
        ));
        foreach ($tables as $table) {
            $className = $this->_underscoreToCamelCase($table);
            $model->template = 'default';
            $model->tableName = $table;
            $model->modelPath = 'application.models.original';
            $model->modelClass = 'C'.$className;
            $model->prepare();
            $model->save();
        }

    }

    protected function _getTables() {
        $tables = Yii::app()->db->schema->getTables();
        $result = array();
        foreach($tables as $table) {
            $result[] = $table->name;
        }
        return $result;
    }

    protected function _underscoreToCamelCase($string) {
        $string = ucfirst($string);
        $func = function ($c) {
            return strtoupper($c[1]);
        };
        return preg_replace_callback('/_([a-z])/', $func, $string);
    }

}