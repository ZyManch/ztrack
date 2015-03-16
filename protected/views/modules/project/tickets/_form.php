<?php
/* @var $this TicketController */
/* @var $model TicketPage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-page-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'parent_page_id',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'parent_page_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
        </div>
		<?php echo $form->error($model,'parent_page_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'author_user_id',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'author_user_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
        </div>
		<?php echo $form->error($model,'author_user_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'assign_user_id',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'assign_user_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
        </div>
		<?php echo $form->error($model,'assign_user_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'page_type_id',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'page_type_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
        </div>
		<?php echo $form->error($model,'page_type_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'project_id',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'project_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
        </div>
		<?php echo $form->error($model,'project_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'url',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
        </div>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
        </div>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'body',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
        </div>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'progress',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'progress',array('class'=>'form-control')); ?>
        </div>
		<?php echo $form->error($model,'progress'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'level_id',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'level_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
        </div>
		<?php echo $form->error($model,'level_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'status',array('size'=>7,'maxlength'=>7,'class'=>'form-control')); ?>
        </div>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'changed',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'changed',array('class'=>'form-control')); ?>
        </div>
		<?php echo $form->error($model,'changed'); ?>
	</div>

	<div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
		    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->