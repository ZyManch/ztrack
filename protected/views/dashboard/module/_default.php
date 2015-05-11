<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 05.04.2015
 * Time: 15:55
 * @var $dashboard_system_module DashboardSystemModule
 */
$systemModule = $dashboard_system_module->getSystemModule();
?>
<div class="ibox widget float-e-margins swappable-panel"  data-panel="<?php echo $dashboard_system_module->id;?>">
    <div class="ibox-title">
        <h5><?php echo $systemModule->getTitle();?></h5>
        <div class="ibox-tools">
            <?php echo CHtml::link(
                '<i class="fa fa-pencil"></i>',
                array(
                    'dashboard/configure',
                    'id'=>$dashboard_system_module->dashboard_id,
                    'dashboard_system_module_id' => $dashboard_system_module->id,
                ),
                array(
                    'class'=>'btn btn-xs',
                    'title'=>'Edit widget'
                )
            );?>
            <?php echo CHtml::link(
                '<i class="fa fa-trash"></i>',
                array(
                    'dashboard/deleteWidget',
                    'id'=>$dashboard_system_module->dashboard_id,
                    'dashboard_system_module_id' => $dashboard_system_module->id,
                ),
                array(
                    'class'=>'btn btn-xs',
                    'title'=>'Delete widget'
                )
            );?>
        </div>
    </div>
    <div class="ibox-content">
        <?php echo $systemModule->renderWidget();?>

    </div>
</div>
