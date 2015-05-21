<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 17.04.2015
 * Time: 8:14
 * @var $module AbstractProjectModule
 * @var $project Project
 * @var $groups Group[]
 */
?>
<div class="modal fade" id="module-<?php echo $module->id;?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'enableAjaxValidation'=>false,
            'action' => array('project/updateModule','id'=>$project->id,'system_module_id'=>$module->id),
            'htmlOptions' => array()
        )); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $module->title;?></h4>
            </div>
            <div class="modal-body">
                <p><?php echo $module->description;?></p>
                <strong>Has access</strong>
                <br>
                <?php echo CHtml::hiddenField('groups');?>
                <?php foreach ($groups as $group):?>
                    <?php if ($group->groupProject):?>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <?php echo CHtml::checkBox(
                                        'groups[]',
                                        isset($group->groupProject->groupProjectModules[$module->id]),
                                        array('value'=>$group->id)
                                    );?>
                                    <?php echo CHtml::encode($group->title);?>
                                </label>
                            </div>
                        </div>
                    <?php endif;?>
                <?php endforeach;?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <?php if ($project->haveSystemModule($module)):?>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <?php if ($module->installation != SystemModule::INSTALLATION_FORCE):?>
                    <?php echo CHtml::link(
                        'Delete',
                        array('project/removeModule','id'=>$project->id,'system_module_id'=>$module->id),
                        array('class'=>'btn btn-danger')
                    );?>
                    <?php endif;?>
                <?php else:?>
                    <button type="submit" class="btn btn-primary">Install</button>
                <?php endif;?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
