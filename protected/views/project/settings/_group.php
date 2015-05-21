<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 17.04.2015
 * Time: 8:07
 * @var $group Group
 * @var $project Project
 */
?>
<a class="btn btn-300 <?php if($group->groupProject):?> btn-warning active<?php else:?> btn-white<?php endif;?>"
    href="<?php echo CHtml::normalizeUrl(array('project/toggleGroup','id'=>$project->id,'group_id'=>$group->id));?>">
    <?php echo CHtml::encode($group->title);?>
    <?php if ($group->groupProject):?>
        <i class="fa fa-check"></i>
    <?php endif;?>
</a>
