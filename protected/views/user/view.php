<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 07.05.2015
 * Time: 15:27
 * @var $model User
 * @var $permissions array
 * @var $groups Group[]
 * @var $this UserController
 */
$canEdit = Yii::app()->user->checkAccess(PERMISSION_USER_MANAGE);
$isMe = (Yii::app()->user->id == $model->id);


?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <?php if ($isMe):?>
                <h2>My profile</h2>
            <?php else:?>
                <h2><?php echo CHtml::encode($model->username);?> profile</h2>
            <?php endif;?>
        </div>

        <div class="ibox-tools">
            <?php if (!$isMe && $canEdit):?>
                <?php echo CHtml::link(
                    'Delete',
                    array('user/delete','id'=>$model->id),
                    array('class'=>'btn btn-danger')
                );?>
            <?php endif;?>
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
        <div class="col-md-8">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Profile</h5>
                </div>
                <div class="ibox-content">
                    <?php $this->renderPartial('//user/view/_profile',array('model'=>$model));?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Groups</h5>
                </div>
                <div class="ibox-content">
                    <?php $this->renderPartial('//user/view/_groups',array('model'=>$model,'groups'=>$groups));?>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Permissions</h5>
                </div>
                <div class="ibox-content">
                    <?php $this->renderPartial('//user/view/_permissions',array('model'=>$model,'permissions'=>$permissions));?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Modules</h5>
                </div>
                <div class="ibox-content">
                    <?php $this->renderPartial('//user/view/_modules',array('model'=>$model,'modules' => $modules));?>
                </div>
            </div>
        </div>
    </div>
</div>
