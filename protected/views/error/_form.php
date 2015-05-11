<?php
/* @var $this ErrorController */
/* @var $model Error */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'error-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class'=>'form-horizontal')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-danger')); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'title',array('class'=>'label label-danger')); ?>
        </div>

	</div>
    <div class="hr-line-dashed"></div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'hash',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'hash',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'hash',array('class'=>'label label-danger')); ?>
        </div>

	</div>
    <div class="hr-line-dashed"></div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'level_id',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'level_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'level_id',array('class'=>'label label-danger')); ?>
        </div>

	</div>
    <div class="hr-line-dashed"></div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'project_id',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'project_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'project_id',array('class'=>'label label-danger')); ?>
        </div>

	</div>
    <div class="hr-line-dashed"></div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'branch_id',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'branch_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'branch_id',array('class'=>'label label-danger')); ?>
        </div>

	</div>
    <div class="hr-line-dashed"></div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'total_count',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'total_count',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'total_count',array('class'=>'label label-danger')); ?>
        </div>

	</div>
    <div class="hr-line-dashed"></div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'trace_file',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'trace_file',array('size'=>60,'maxlength'=>200,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'trace_file',array('class'=>'label label-danger')); ?>
        </div>

	</div>
    <div class="hr-line-dashed"></div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'trace_line',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'trace_line',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'trace_line',array('class'=>'label label-danger')); ?>
        </div>

	</div>
    <div class="hr-line-dashed"></div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'status',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'status',array('size'=>7,'maxlength'=>7,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'status',array('class'=>'label label-danger')); ?>
        </div>

	</div>
    <div class="hr-line-dashed"></div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'changed',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'changed',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'changed',array('class'=>'label label-danger')); ?>
        </div>

	</div>
    <div class="hr-line-dashed"></div>
	<div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
		    <?php echo CHtml::link('Cancel',array('Error/index'),array('class'=>'btn btn-white')); ?>
		    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->