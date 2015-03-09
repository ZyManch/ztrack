<?php
/* @var $this ProjectController */
/* @var $model Project */


$currentModule = Yii::app()->request->getParam('module');
$currentAction = Yii::app()->request->getParam('action');
$activeSystemModule = null;
?>
<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1><?php echo $model->title; ?></h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <ul class="nav nav-tabs">
            <?php foreach ($model->systemModules as $systemModule):?>
                <?php foreach ($systemModule->getTabs() as $tab):?>
                    <?php
                    if (!$currentModule) {
                        $currentModule = $systemModule->getModuleName();
                    }
                    $isActive = ($currentModule==$systemModule->getModuleName());
                    if ($isActive) {
                        $activeSystemModule = $systemModule;
                        if (!$currentAction) {
                            $currentAction = $activeSystemModule->defaultAction;
                        }
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
<?php if ($activeSystemModule && $activeSystemModule->hasAccess($currentAction)):?>
    <?php $activeSystemModule->run($currentAction);?>
<?php else:?>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel colourable">
                <div class="panel-body">
                    <div class="alert alert-danger">Action not found</div>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
