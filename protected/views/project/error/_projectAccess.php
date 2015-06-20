<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 20.06.2015
 * Time: 15:17
 * @var $model Project
  */
$websUser = Yii::app()->user;
?>
You have not access to this project.<br>
<?php if ($model->groups):?>
    Only users from next groups have access to this project:<br>
    <ul>
        <?php foreach ($model->groups as $group):?>
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
        <?php endforeach;?>
    </ul>
<?php else:?>
    Groups with access to this project is not exists.<br>
    You can add access on <?php echo CHtml::link('group page',array('group/admin'),array('target'=>'_blank'));?>
<?php endif;?>