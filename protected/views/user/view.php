<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 07.05.2015
 * Time: 15:27
 * @var $model User
 * @var $permissions array
 * @var $groups Group[]
 * @var $form CActiveForm
 */
$canEdit = Yii::app()->user->checkAccess(PERMISSION_USER_MANAGE);
$isMe = (Yii::app()->user->id == $model->id);
Yii::app()->clientScript->registerScript(
    'permissions',
    sprintf(
        '$(".permissions input").change(function() {
            var $this = $(this),
                $parent = $this.parents(".permission");
            if($this.is(":checked")) {
                $parent.addClass("checked");
                $.ajax({
                    url: "%s",
                    method: "POST",
                    data: {permission_id: $this.data("permission")}
                });
            } else {
                $parent.removeClass("checked");
                $.ajax({
                    url: "%s",
                    method: "POST",
                    data: {permission_id: $this.data("permission")}
                });
            }
        });',
        CHtml::normalizeUrl(array('user/addPermission','id'=>$model->id)),
        CHtml::normalizeUrl(array('user/removePermission','id'=>$model->id))
    )
);
Yii::app()->clientScript->registerScript(
    'groups',
    sprintf(
        '$(".groups input").change(function() {
            var $this = $(this),
                $parent = $this.parents(".group");
            if($this.is(":checked")) {
                $parent.addClass("checked");
                $.ajax({
                    url: "%s",
                    method: "POST",
                    data: {group_id: $this.data("group")}
                });
            } else {
                $parent.removeClass("checked");
                $.ajax({
                    url: "%s",
                    method: "POST",
                    data: {group_id: $this.data("group")}
                });
            }
        });',
        CHtml::normalizeUrl(array('user/addGroup','id'=>$model->id)),
        CHtml::normalizeUrl(array('user/removeGroup','id'=>$model->id))
    )
);
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
                        </div>
                        <?php echo $form->error($model,'username',array('class'=>'label label-danger')); ?>
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
                        </div>
                        <?php echo $form->error($model,'email',array('class'=>'label label-danger')); ?>
                    </div>
                    <?php if ($isMe):?>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'password',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>64,'class'=>'form-control','value'=>'')); ?>
                        </div>
                        <?php echo $form->error($model,'password',array('class'=>'label label-danger')); ?>
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
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Groups</h5>
                </div>
                <div class="ibox-content">
                    <table class="table groups checkbox-list">
                        <tbody>
                        <?php foreach ($groups as $group):?>
                            <tr>

                                <td class="checkbox-item group<?php if (isset($model->groups[$group->id])):?> checked<?php endif;?>">
                                    <label>
                                        <?php echo CHtml::encode($group->title);?>
                                        <?php if($canEdit):?>
                                            <input type="checkbox" data-group="<?php echo $group->id;?>" <?php if (isset($model->groups[$group->id])):?>checked="checked" <?php endif;?>/>
                                        <?php endif;?>
                                    </label>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Permissions</h5>
                </div>
                <div class="ibox-content">
                    <table class="table  permissions checkbox-list">
                        <tbody>
                            <?php foreach ($permissions as $group => $groupPermission):?>
                                <tr>
                                <?php foreach ($groupPermission as $permissionId => $permissionTitle):?>

                                    <td class="checkbox-item permission<?php if (isset($model->permissions[$permissionId])):?> checked<?php endif;?>">
                                        <label>
                                            <?php echo $permissionTitle;?>
                                            <?php if($canEdit):?>
                                            <input type="checkbox" data-permission="<?php echo $permissionId;?>" <?php if (isset($model->permissions[$permissionId])):?>checked="checked" <?php endif;?><?php if ($permissionId == PERMISSION_ROOT && $model->id == Yii::app()->user->id):?> disabled="disabled"<?php endif;?>/>
                                            <?php endif;?>
                                        </label>
                                    </td>

                                <?php endforeach;?>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
