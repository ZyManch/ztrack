<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 20.03.2015
 * Time: 14:09
 * @var $data PageHistory
 */
?>
<div class="feed-element">
    <?php echo $data->user->getGravatarLink('38',array('class'=>'pull-left'));?>
    <div class="media-body ">
        <small class="pull-right"><?php echo Yii::app()->dateFormatter->diff(strtotime($data->created));?></small>
        <small class="text-muted"><?php echo Yii::app()->dateFormatter->formatDateTime(strtotime($data->created));?></small>
        <div class="well">
            <ul>
                <?php foreach ($data->getChangesAttributes() as $attribute):?>
                    <li>
                    <?php if ($attribute == 'assign_user_id'):?>
                        Attribute <b><?php echo $data->getAttributeLabel($attribute);?></b> is changed
                        <?php if ($data->previousPageHistory->assign_user_id):?>
                            from <?php echo CHtml::link(
                                CHtml::encode($data->previousPageHistory->assignUser->username),
                                array('user/view','id'=>$data->previousPageHistory->assignUser->id)
                            );?>
                        <?php endif;?>
                        to
                        <?php echo CHtml::link(
                            CHtml::encode($data->assignUser->username),
                            array('user/view','id'=>$data->assignUser->id)
                        );?>
                    <?php elseif ($attribute == 'body') :?>
                        <b>Description</b> changed (<?php echo CHtml::link('diff',array(
                            'history/view',
                            'id'=>$data->id
                        ));?>)
                    <?php else:?>
                         Attribute <b><?php echo $data->getAttributeLabel($attribute);?></b> changed
                        <?php if ($data->previousPageHistory->$attribute):?>
                            from <?php echo CHtml::encode($data->previousPageHistory->$attribute);?>
                        <?php endif;?>
                        to
                        <?php echo CHtml::encode($data->$attribute);?>
                    <?php endif;?>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>