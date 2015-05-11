<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 11.05.2015
 * Time: 16:05
 * @var $form CActiveForm
 * @var $model User
 */
$isMe = (Yii::app()->user->id == $model->id);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'profile-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('class'=>'form-horizontal')
)); ?>
<?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-danger')); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model,'username',array('class'=>'col-sm-3 control-label')); ?>
        <div class="col-sm-9">
            <?php if ($isMe):?>
                <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
            <?php else:?>
                <div class="form-control">
                    <?php echo CHtml::encode($model->username);?>
                </div>
            <?php endif;?>
            <?php echo $form->error($model,'username',array('class'=>'label label-danger')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'email',array('class'=>'col-sm-3 control-label')); ?>
        <div class="col-sm-9">
            <?php if ($isMe):?>
                <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
            <?php else:?>
                <div class="form-control">
                    <?php echo CHtml::encode($model->email);?>
                </div>
            <?php endif;?>
            <?php echo $form->error($model,'email',array('class'=>'label label-danger')); ?>
        </div>
    </div>
<?php if ($isMe):?>
    <div class="form-group">
        <?php echo $form->labelEx($model,'password',array('class'=>'col-sm-3 control-label')); ?>
        <div class="col-sm-9">
            <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>64,'class'=>'form-control','value'=>'')); ?>
            <?php echo $form->error($model,'password',array('class'=>'label label-danger')); ?>
        </div>

    </div>
<?php endif;?>
<?php if($isMe):?>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-3">

            <?php echo CHtml::submitButton(
                $model->isNewRecord ? 'Create' : 'Save',
                array('class'=>'btn btn-primary')
            ); ?>
        </div>
    </div>
<?php endif;?>
<?php $this->endWidget(); ?>