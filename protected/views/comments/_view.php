<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 17.03.2015
 * Time: 14:39
 * @var $data Message
 */
?>
<div class="feed-element">
    <?php echo $data->user->getGravatarLink('38',array('class'=>'pull-left'));?>
    <div class="media-body ">
        <small class="pull-right"><?php echo Yii::app()->dateFormatter->diff(strtotime($data->changed));?></small>
        <small class="text-muted"><?php echo Yii::app()->dateFormatter->formatDateTime(strtotime($data->changed));?></small>
        <div class="well">
            <?php echo $data->getBodyAsHtml();?>
        </div>
    </div>
</div>