<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $activeModule AbstractProjectModule */

$webUser = Yii::app()->user;
$user = $webUser->getUser();
$userProjects = $user->getAvailableProjects();
$userProjectModules = $model->getEnabledProjectModules($user);
$currentAction = Yii::app()->request->getParam('action');
$userHaveAccessToModule = false;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2><?php echo $model->title; ?></h2>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="col-xs-12">
        <ul class="nav nav-tabs">
            <?php foreach ($userProjectModules as $systemModule):?>
                <?php foreach ($systemModule->getTabs() as $tab):?>
                    <?php
                    $isActive = ($activeModule->id == $systemModule->id);
                    if ($isActive) {
                        $userHaveAccessToModule = true;
                    }
                    if ($isActive && !$currentAction) {
                        $currentAction = $activeModule->defaultAction;
                    }
                    ?>
                    <li<?php if($isActive):?> class="active" <?php endif;?>>
                        <?php echo CHtml::link(
                            $tab['label'],
                            array('project/view','id'=>$model->id,'module' => $systemModule->getModuleName())
                        );?>
                    </li>
                <?php endforeach;?>
            <?php endforeach;?>
        </ul>
    </div>
</div>
<?php if ($userHaveAccessToModule && $activeModule->hasAccess($currentAction)):?>
    <?php $activeModule->run($currentAction);?>
<?php else:?>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel colourable">
                <div class="panel-body">
                    <div class="alert alert-danger">
                        <?php if(!$model->haveSystemModule($activeModule)):?>
                            <?php $this->renderPartial('//project/error/_moduleInstallation',array('model'=>$model));?>
                        <?php elseif (!isset($userProjects[$model->id])):?>
                            <?php $this->renderPartial('//project/error/_projectAccess',array('model'=>$model));?>
                        <?php else:?>
                            <?php $this->renderPartial('//project/error/_moduleAccess',array('model'=>$model,'module'=>$activeModule));?>

                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
