<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 17:32
 */
Yii::import('app.extensions.php-wiki-parser.WikiParser.*',true);

class WikiEditor extends AbstractEditor {

    public function getHtmlEditor($model,$attribute,$htmlOptions = array()) {
        if (!isset($htmlOptions['class'])) {
            $htmlOptions['class'] = 'form-control';
        }
        return CHtml::activeTextArea($model, $attribute, $htmlOptions);
    }

    public function parse($content) {
        $parser = new WikiParser_WikiParser();
        return $parser->parse($content);
    }

}