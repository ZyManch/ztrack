<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 20.06.2015
 * Time: 15:17
 * @var $model Project
 * @var $module AbstractProjectModule
 */
$groupsCount = 0;
$webUser = Yii::app()->user;
?>
You have not access to this project page.<br>
Only users from next groups have access to this project page:<br>
<ul>
    <?php foreach ($model->groups as $group):?>
        <?php if ($group->groupProjects[$model->id]->groupProjectModules[$module->id]):?>
            <li>
                <?php if ($webUser->checkAccess(PERMISSION_GROUP_MANAGE)):?>
                    <?php echo CHtml::link(
                        CHtml::encode($group->title),
                        array('group/update','id'=>$group->id),
                        array('target'=>'_blank')
                    );?>
                <?php else:?>
                    <?php echo CHtml::encode($group->title);?>
                <?php endif;?>
            </li>
            <?php $groupsCount++;?>
        <?php endif;?>
    <?php endforeach;?>
    <?php if (!$groupsCount && !Yii::app()->user->checkAccess(PERMISSION_GROUP_MANAGE)):?>
    <li>Empty</li>
    <?php endif;?>
    <?php if (Yii::app()->user->checkAccess(PERMISSION_GROUP_MANAGE)):?>
        <li><?php echo CHtml::link('Add new group',array('group/admin'),array('target'=>'_blank'));?></li>
    <?php endif;?>
    <?php if (Yii::app()->user->checkAccess(PERMISSION_GROUP_MANAGE)):?>
        <li><?php echo CHtml::link('Add access to exist group',array('project/update','id'=>$model->id),array('target'=>'_blank'));?></li>
    <?php endif;?>
</ul>