<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 01.10.2015
 * Time: 17:40
 * @var $model Page
 * @var $form CActiveForm
 */
$blankTime = new UserTime();
$blankTime->started = date('Y-m-d H:i:s',DateFormatter::getCurrentTimestamp())
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'ticket-page-form',
    'enableAjaxValidation'=>false,
    'action' => array(
        'module/view',
        'module'=>'timer',
        'action'=>'start',
        'ticket_id'=>$model->id
    ),
    'htmlOptions' => array('class'=>'form-horizontal')
)); ?>
<div class="form-group">
    <?php echo $form->labelEx($blankTime,'started',array(
        'class'=>'col-sm-3 control-label',
        'required' => false
    )); ?>
    <div class="col-sm-9">
        <?php echo $form->dateTimeField($blankTime,'started',array('class'=>'form-control')); ?>
    </div>

</div>
<div class="">
    <?php echo $form->labelEx($blankTime,'description',array(
        'class'=>'control-label',
        'required' => false
    )); ?>
    <?php echo $form->textArea($blankTime,'description',array('class'=>'form-control')); ?>
</div>
<div class="text-center">
    <?php echo CHtml::submitButton('Start',array('class'=>'btn btn-primary')); ?>
    <?php echo CHtml::button('Cancel',array(
        'class'=>'btn btn-white',
        'onclick' => '$("#start-ticket-timer").popover("hide")'
    )); ?>
</div>
<?php $this->endWidget(); ?>
