<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 12.03.2015
 * Time: 18:18
 * @var $settings AbstractProjectModule[]
 * @var $project Project
 * @var $groups Group[]
 */
?>

<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Groups</h2>
                        <div>
                            <?php foreach ($groups as $group):?>
                                <div class="separated-element<?php if($group->groupProjects):?> bg-success<?php endif;?>">
                                    <?php echo CHtml::encode($group->title);?>
                                    <?php echo CHtml::link(
                                        sprintf('<i class="%s"></i>',$group->groupProjects ? 'fa fa-times': 'fa fa-check'),
                                        array('project/view','id'=>$project->id,'module'=>'settings','action'=>'toggleGroup','group_id'=>$group->id),
                                        array('class'=>''.($group->groupProjects?'text-danger':'text-info'))
                                    );?>
                                </div>
                            <?php endforeach;?>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Installed modules</h2>
                        <?php foreach ($settings as $setting):?>
                        <?php if ($project->haveSystemModule($setting)):?>
                            <div class="btn btn-primary btn-module  btn-block" data-toggle="modal" data-target="#module-<?php echo $setting->id;?>">
                                <h3><?php echo CHtml::encode($setting->title);?></h3>
                                <p><?php echo $setting->description;?></p>
                            </div>
                        <?php endif;?>
                        <?php endforeach;?>
                    </div>
                    <div class="col-sm-6">
                        <h2>Not installed modules</h2>
                        <?php foreach ($settings as $setting):?>
                            <?php if (!$project->haveSystemModule($setting)):?>
                                <div class="btn btn-white btn-module  btn-block" data-toggle="modal" data-target="#module-<?php echo $setting->id;?>">
                                    <h3><?php echo CHtml::encode($setting->title);?></h3>
                                    <p>
                                        <?php echo $setting->description;?>
                                    </p>
                                    <strong>Installed for: </strong>
                                    <?php foreach ($setting->groupProjectModules as $groupProjectModule):?>
                                        <?php echo CHtml::link(
                                            CHtml::encode($groupProjectModule->groupProject->group->title),
                                            array('group/view','id'=>$groupProjectModule->groupProject->group->id)
                                        );?>
                                    <?php endforeach;?>
                                    <?php if (!$setting->groupProjectModules):?>
                                        no one
                                    <?php endif;?>
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php foreach ($settings as $setting):?>
    <div class="modal fade" id="module-<?php echo $setting->id;?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'enableAjaxValidation'=>false,
                'action' => array('project/view','id'=>$project->id,'module'=>'settings','action'=>'save','system_module_id'=>$setting->id),
                'htmlOptions' => array()
            )); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $setting->title;?></h4>
                </div>
                <div class="modal-body">
                    <p><?php echo $setting->description;?></p>
                    <strong>Has access</strong>
                    <br>
                    <?php echo CHtml::hiddenField('groups');?>
                    <?php foreach ($project->groupProjects as $groupProject):?>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <?php echo CHtml::checkBox(
                                        'groups[]',
                                        isset($setting->groupProjects[$groupProject->group_id]),
                                        array('value'=>$groupProject->group_id)
                                    );?>
                                    <?php echo CHtml::encode($groupProject->group->title);?>
                                </label>
                            </div>
                        </div>
                    <?php endforeach;?>

                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <?php if ($project->haveSystemModule($setting)):?>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <?php echo CHtml::link(
                            'Delete',
                            array('project/view','id'=>$project->id,'module'=>'settings','action'=>'delete','system_module_id'=>$setting->id),
                            array('class'=>'btn btn-danger')
                        );?>
                    <?php else:?>
                        <button type="submit" class="btn btn-primary">Install</button>
                    <?php endif;?>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
<?php endforeach;?>