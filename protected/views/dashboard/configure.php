<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 05.04.2015
 * Time: 22:46
 * @var DashboardSystemModule $dashboardSystemModule
 * @var AbstractWidgetModule $systemModule
 * @var DashboardController $this
 */
$systemModule = $dashboardSystemModule->systemModule;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2><?php echo $systemModule->getTitle();?></h2>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Редактирование</h5>
            </div>
            <div class="ibox-content">
                <?php $systemModule->renderConfigure(
                    $dashboardSystemModule->params ?
                        json_decode($dashboardSystemModule->params,1):
                        null
                );?>
            </div>
        </div>
    </div>