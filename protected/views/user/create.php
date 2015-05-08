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

                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
</div>