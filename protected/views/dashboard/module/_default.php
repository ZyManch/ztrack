<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 05.04.2015
 * Time: 15:55
 * @var $dashboard_system_module DashboardSystemModule
 */
$systemModule = $dashboard_system_module->getSystemModule();
?>
<div class="stat-panel col-md-6">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5><?php echo $systemModule->getTitle();?></h5>
            <div class="ibox-tools">
                <?php echo CHtml::link(
                    'Edit',
                    array(
                        'dashboard/configure',
                        'id'=>$dashboard_system_module->dashboard_id,
                        'dashboard_system_module_id' => $dashboard_system_module->id,
                    ),
                    array(
                        'class'=>'btn btn-xs'
                    )
                );?>
            </div>
        </div>
        <div class="ibox-content">
            <?php echo $systemModule->renderWidget();?>

        </div>
    </div>
</div>