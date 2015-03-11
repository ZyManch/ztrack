<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 17:32
 */
Yii::import('application.extensions.wiky.wiky',true);
class WikiEditor extends AbstractEditor {

    public function getHtmlEditor($model,$attribute,$htmlOptions = array()) {
        if (!isset($htmlOptions['class'])) {
            $htmlOptions['class'] = 'form-control';
        }
        if (!isset($htmlOptions['rows'])) {
            $htmlOptions['rows'] = 18;
        }
        return CHtml::activeTextArea($model, $attribute, $htmlOptions);
    }

    public function parse($content) {
        $parser = new wiky();
        return $parser->parse($content);
    }

}