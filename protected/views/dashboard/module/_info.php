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
    <div class="panel panel-info">
        <div class="panel-heading">
            <h5><?php echo $systemModule->getTitle();?></h5>
        </div>
        <div class="panel-body">
            <?php echo $systemModule->draw();?>

        </div>
    </div>
</div>