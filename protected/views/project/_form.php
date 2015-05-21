<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $form CActiveForm */
/* @var $user User */
$user = Yii::app()->user->getUser();
$projectIds = array_keys($user->getAvailableProjects());
$projects = Project::getProjectsAsList($projectIds,$model->id ? array($model->id) : array());
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
    'htmlOptions' => array('class'=>'form-horizontal'),
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <div class="form-group">
		<?php echo $form->labelEx($model,'title',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'title',array('class'=>'label label-danger')); ?>
        </div>
	</div>

    <div class="form-group">
		<?php echo $form->labelEx($model,'parent_id',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <?php echo $form->dropDownList(
                $model,
                'parent_id',
                $projects,
                array('class'=>'form-control')
            ); ?>
            <?php echo $form->error($model,'parent_id',array('class'=>'label label-danger')); ?>
        </div>
	</div>

    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
            <?php echo CHtml::link('Cancel',array('project/admin'),array('class'=>'btn btn-white'));?>
        </div>
    </div>



<?php $this->endWidget(); ?>

</div><!-- form -->