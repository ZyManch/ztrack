<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 17.04.2015
 * Time: 8:09
 * @var $module AbstractProjectModule
 * @var $project Project
 * @var $groups Group[]
 * @var $showInstalled
 */
?>

<?php if ($project->haveSystemModule($module)==$showInstalled):?>
    <div class="btn <?php if($showInstalled):?>btn-primary<?php else:?>btn-white<?php endif;?> btn-module  btn-block"
        data-toggle="modal" data-target="#module-<?php echo $module->id;?>">
        <h3><?php echo CHtml::encode($module->title);?></h3>
        <p><?php echo $module->description;?></p>
        <?php if ($showInstalled):?>
            <strong>Installed for: </strong>
            <?php $groupCount = 0;?>
            <?php foreach ($groups as $group):?>
                <?php if ($group->groupProject && isset($group->groupProject->groupProjectModules[$module->id])):?>
                    <?php echo CHtml::link(
                        CHtml::encode($group->title),
                        array('group/view','id'=>$group->id)
                    );?>
                    <?php $groupCount++;?>
                <?php endif;?>
            <?php endforeach;?>
            <?php if (!$groupCount):?>
                no one
            <?php endif;?>
        <?php endif;?>
    </div>
<?php endif;?>