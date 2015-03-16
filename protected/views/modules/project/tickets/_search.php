<?php
/* @var $this TicketController */
/* @var $model TicketPage */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parent_page_id'); ?>
		<?php echo $form->textField($model,'parent_page_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'author_user_id'); ?>
		<?php echo $form->textField($model,'author_user_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'assign_user_id'); ?>
		<?php echo $form->textField($model,'assign_user_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'page_type_id'); ?>
		<?php echo $form->textField($model,'page_type_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_id'); ?>
		<?php echo $form->textField($model,'project_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'progress'); ?>
		<?php echo $form->textField($model,'progress',array('class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'level_id'); ?>
		<?php echo $form->textField($model,'level_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>7,'maxlength'=>7,'class'=>'form-control')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'changed'); ?>
		<?php echo $form->textField($model,'changed',array('class'=>'form-control')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->