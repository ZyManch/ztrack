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
<div class="widget lazur-bg p-xl  swappable-panel"  data-panel="<?php echo $dashboard_system_module->id;?>">
    <h5><?php echo $systemModule->getTitle();?></h5>
    <div class="panel-body">
        <?php echo $systemModule->renderWidget();?>

    </div>
</div>
