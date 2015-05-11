<?php
/* @var $this DashboardController */
/* @var $model Dashboard */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dashboard-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('class'=>'form-horizontal')
)); ?>
	<?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-danger')); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'name',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'name',array('class'=>'label label-danger')); ?>
        </div>

	</div>

    <div class="hr-line-dashed"></div>
	<div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
            <?php echo CHtml::link(
                'Cancel',
                array('dashboard/index'),
                array('class'=>'btn btn-white')
            );?>
		    <?php echo CHtml::submitButton(
                $model->isNewRecord ? 'Create' : 'Save',
                array('class'=>'btn btn-primary')
            ); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->