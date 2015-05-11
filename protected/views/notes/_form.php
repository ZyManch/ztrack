<?php
/* @var $this NotesController */
/* @var $model Page */
/* @var $form CActiveForm */
/* @var $top_id int */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('class'=>'form-horizontal')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="form-group">
		<?php echo $form->labelEx($model,'title',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'title',array('class'=>'label label-danger')); ?>
        </div>

	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'body',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		<?php echo Yii::app()->user->getEditor()->getHtmlEditor($model,'body'); ?>
        <?php echo $form->error($model,'body',array('class'=>'label label-danger')); ?>
        </div>

	</div>


	<div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
		    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
            <?php echo CHtml::link('Cancel',array('notes/index','id'=>$top_id),array('class'=>'btn btn-white'));?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->