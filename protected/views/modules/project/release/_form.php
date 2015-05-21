<?php
/* @var $this ProjectController */
/* @var $model ReleasePage */
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
    'htmlOptions' => array('class'=>'form-horizontal')
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <div class="hr-line-dashed"></div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-2">
		    <?php echo $form->textField($model,'title',array('maxlength'=>128,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'title',array('class'=>'label label-danger')); ?>
        </div>

	</div>


    <div class="hr-line-dashed"></div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'body',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo Yii::app()->user->getUser()->company->editor->getHtmlEditor($model,'body',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'body',array('class'=>'label label-danger')); ?>
        </div>

	</div>

    <div class="hr-line-dashed"></div>


	<div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
		    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
            <?php echo CHtml::link('Cancel',array(
                'project/view',
                'id' => $model->project_id,
                'module'=>'release',
            ),array('class'=>'btn btn-white'));?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->