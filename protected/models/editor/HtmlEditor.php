<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 17:32
 */
class HtmlEditor extends AbstractEditor {

    static $assetsAdded = false;

    public function getHtmlEditor($model,$attribute,$htmlOptions = array()) {
        if (!self::$assetsAdded) {
            $clientScript = Yii::app()->clientScript;
            $clientScript->registerCssFile('/css/summernote.css');
            $clientScript->registerCssFile('/css/summernote-bs3.css');
            $clientScript->registerScriptFile('/js/summernote.min.js');
            $clientScript->registerScript(
                'summernote',
                '$(".summernote").summernote();
                $(".summernote").each(function() {
                    var $summernote = $(this),
                        $form = $summernote.parents("form");
                    $form.submit(function() {
                        $("#"+$summernote.data("input")).val($summernote.code());
                    });

                });
                ',
                CClientScript::POS_READY
            );
            self::$assetsAdded = true;
        }
        $id = CHtml::ID_PREFIX.CHtml::$count++;
        return CHtml::tag(
            'div',
            array('class'=>'summernote','data-input'=>$id),
            $model->$attribute
        ).CHtml::activeHiddenField($model,$attribute,array('id'=>$id));
    }

    public function parse($content) {
        return $content;
    }

}