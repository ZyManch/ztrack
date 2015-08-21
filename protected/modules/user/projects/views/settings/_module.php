<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 17.04.2015
 * Time: 8:09
 * @var $projectModule AbstractProjectModule
 * @var $project Project
 * @var $groups Group[]
 * @var $showInstalled
 */
?>

<?php if ($project->haveSystemModule($projectModule)==$showInstalled):?>
    <div class="btn <?php if($showInstalled):?>btn-primary<?php else:?>btn-white<?php endif;?> btn-module  btn-block"
        data-toggle="modal" data-target="#module-<?php echo $projectModule->id;?>">
        <h3><?php echo CHtml::encode($projectModule->title);?></h3>
        <p><?php echo $projectModule->description;?></p>
        <?php if ($showInstalled):?>
            <strong>Installed for: </strong>
            <?php $groupCount = 0;?>
            <?php foreach ($groups as $group):?>
                <?php if ($group->groupProject && isset($group->groupProject->groupProjectModules[$projectModule->id])):?>
                    <?php echo CHtml::link(
                        CHtml::encode($group->title),
                        array('module/view','module' => 'projects','action' => 'view','id'=>$group->id)
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