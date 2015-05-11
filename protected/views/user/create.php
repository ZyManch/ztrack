<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 08.05.2015
 * Time: 13:11
 * @var $model User
 * @var $form CActiveForm
 */
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2>Invite new user</h2>
        </div>

        <div class="ibox-tools">
            <?php echo CHtml::link(
                'All users',
                array('user/index'),
                array('class'=>'btn btn-primary')
            );?>

        </div>
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Profile</h5>
                </div>
                <div class="ibox-content">
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'profile-form',
                        'enableAjaxValidation'=>false,
                        'htmlOptions' => array('class'=>'form-horizontal')
                    )); ?>
                    <?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-danger')); ?>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'email',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
                            <?php echo $form->error($model,'email',array('class'=>'label label-danger')); ?>
                        </div>

                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'username',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
                            <?php echo $form->error($model,'username',array('class'=>'label label-danger')); ?>
                        </div>

                    </div>


                    <div class="form-group">
                        <?php echo $form->labelEx($model,'group_id',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->dropDownList(
                                $model,
                                'group_id',
                                Group::getVariants(array('company_id'=>Yii::app()->user->getUser()->company_id)),
                                array('class'=>'form-control','empty'=>'No group')
                            ); ?>
                            <?php echo $form->error($model,'group_id',array('class'=>'label label-danger')); ?>
                        </div>

                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-3">

                            <?php echo CHtml::submitButton(
                                'Invite',
                                array('class'=>'btn btn-primary')
                            ); ?>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
</div>