<?php
/* @var $this TicketController */
/* @var $model TicketPage */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile('/js/jquery.nouislider.all.min.js');
Yii::app()->clientScript->registerCssFile('/css/jquery.nouislider.css');
Yii::app()->clientScript->registerScript('progress','
            var a = $("#progress-bar").noUiSlider({
                    start:  '.$model->progress.',
                    behaviour: "tap",
                    connect: "lower",
                    step: 5,
                    range: {min:  0,max:  100}
            });
            $("#progress-bar").Link("lower").to($("#progress-input"),null, wNumb({decimals: 0}));
');
$projectIds = array_keys(Yii::app()->user->getUser()->getAvailableProjects());
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

	<div class="form-group">
		<?php echo $form->labelEx($model,'parent_page_id',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-4">
		    <?php echo $form->textField($model,'parent_page_id',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'parent_page_id',array('class'=>'label label-danger')); ?>
        </div>


        <?php echo $form->labelEx($model,'project_id',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-4">
            <?php echo $form->dropDownList($model,'project_id',Project::getProjectsAsList($projectIds),array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'project_id',array('class'=>'label label-danger')); ?>
        </div>

	</div>

    <div class="hr-line-dashed"></div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
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
		<?php echo $form->labelEx($model,'progress',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
            <div id="progress-bar" class=""></div>
		    <?php echo $form->hiddenField($model,'progress',array('id'=>'progress-input')); ?>
            <?php echo $form->error($model,'progress',array('class'=>'label label-danger')); ?>
        </div>

	</div>

    <div class="hr-line-dashed"></div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'level_id',array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-10">
		    <?php echo $form->dropDownList($model,'level_id',Level::getVariants(),array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'level_id',array('class'=>'label label-danger')); ?>
        </div>

	</div>


    <div class="hr-line-dashed"></div>

	<div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
		    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
            <?php if ($model->parent_page_id):?>
                <?php echo CHtml::link('Cancel',array(
                    'project/view',
                    'id' => $model->project_id,
                    'module'=>'tickets',
                    'action'=>'view',
                    'ticket_id' => $model->parent_page_id
                ),array('class'=>'btn btn-white'));?>
            <?php else:?>
                <?php echo CHtml::link('Cancel',array(
                    'project/view',
                    'id' => $model->project_id,
                    'module'=>'tickets',
                ),array('class'=>'btn btn-white'));?>
            <?php endif;?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->