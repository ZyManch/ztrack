<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'message-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'user_id',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'user_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'user_id',array('class'=>'label label-danger')); ?>
        </div>

	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'body',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'body',array('class'=>'label label-danger')); ?>
        </div>

	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'status',array('size'=>7,'maxlength'=>7,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'status',array('class'=>'label label-danger')); ?>
        </div>

	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'changed',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'changed',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'changed',array('class'=>'label label-danger')); ?>
        </div>

	</div>

	<div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
		    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->