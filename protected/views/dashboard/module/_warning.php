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
<div class="stat-panel col-md-<?php echo $dashboard_system_module->rows;?>">
    <div class="widget yellow-bg p-lg text-center">
        <h5><?php echo $systemModule->getTitle();?></h5>
        <div class="panel-body">
            <?php echo $systemModule->renderWidget();?>

        </div>
    </div>
</div>