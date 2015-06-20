<?php
/* @var $this GroupController */
/* @var $model Group */
/* @var $form CActiveForm */
/* @var $users User[] */
$users = User::getVariants();
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'group-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('class'=>'form-horizontal')
)); ?>
<div class="row">
    <div class="col-md-6">
        <div class="form">
            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-danger')); ?>

            <div class="form-group">
                <?php echo $form->labelEx($model,'title',array('class'=>'col-sm-2 control-label')); ?>
                <div class="col-sm-10">
                    <?php echo $form->textField($model,'title',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
                </div>
                <?php echo $form->error($model,'title',array('class'=>'label label-danger')); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'type',array('class'=>'col-sm-2 control-label')); ?>
                <div class="col-sm-10">
                    <?php echo $form->dropDownList(
                        $model,
                        'type',
                        array(Group::TYPE_NORMAL => 'Normal',Group::TYPE_HIDDEN => 'Hidden'),
                        array('class'=>'form-control')
                    ); ?>
                </div>
                <?php echo $form->error($model,'type',array('class'=>'label label-danger')); ?>
            </div>

        </div><!-- form -->
    </div>
    <div class="col-md-6">
        <label class="control-label">Users</label>
        <div class="row">
        <?php foreach ($users as $userId => $username):?>
            <label class="col-xs-4">
                <input type="checkbox" <?php if (isset($model->users[$userId])):?>checked="checked" <?php endif;?> value="<?php echo $userId;?>" name="users[]"/>
                <?php echo CHtml::encode($username);?>
            </label>
        <?php endforeach;?>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-md-4 col-md-offset-1">
            <?php echo CHtml::link('Cancel',array('group/admin'),array('class'=>'btn btn-white')); ?>
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
        </div>

</div>
<?php $this->endWidget(); ?>