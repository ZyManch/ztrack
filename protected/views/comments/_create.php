<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 17.03.2015
 * Time: 18:32
 */
Yii::app()->clientScript->registerScript(
    'comment_add',
    '$(document).ready(function() {
        $("#comment_add").click(function() {
            $(this).hide();
            $(this).parents(".feed-element").find("form").show();
        });
    });'
);
$model = new Message();
?>
<div class="feed-element">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'comment-form',
        'action' => array(
            'message/createForTicket',
            'ticket_id' => Yii::app()->request->getParam('ticket_id')
        ),
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('style'=>'display:none')
    )); ?>
    <div class="form-group">
        <?php echo Yii::app()->user->getUser()->company->editor->getHtmlEditor(
            $model,
            'body',
            array(
                'rows' => 5
            )
        );?>
    </div>
    <div class="form-group">

        <?php echo CHtml::submitButton('Create',array('class'=>'btn btn-primary')); ?>
    </div>
    <?php $this->endWidget(); ?>
    <div class="text-right">
        <?php echo CHtml::button('Add comment',array('class'=>'btn btn-primary','id'=>'comment_add')); ?>
    </div>
</div>