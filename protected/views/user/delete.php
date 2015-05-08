<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 08.05.2015
 * Time: 11:29
 * @var $model User
 */
?>
<div class="wrapper wrapper-content">
    <div class="row ">
        <div class="col-xs-6 col-xs-push-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Delete user</h5>
                </div>
                <div class="ibox-content">
                    You are sure delete <strong><?php echo CHtml::encode($model->username);?></strong> user?
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="text-right">
                            <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'delete-form',
                                'enableAjaxValidation'=>false,
                                'htmlOptions' => array('class'=>'form-horizontal')
                            )); ?>
                            <?php echo CHtml::link(
                                'Cancel',
                                array('user/index'),
                                array('class'=>'btn btn-white')
                            ); ?>
                            <?php echo CHtml::submitButton(
                                'Delete',
                                array('class'=>'btn btn-danger')
                            ); ?>
                            <?php $this->endWidget(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>