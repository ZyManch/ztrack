<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 10:28
 * @var Dashboard[] $dashboards
 * @var int $id
 */
Yii::app()->clientScript->registerScript(
    'WinMove',
    'var panels = WinMove(function(event, ui) {
        alert(panels.sortable("serialize",{"attribute":"data-panel"}));
    });
    '
);
$selectedDashboard = ($id && isset($dashboards[$id]) ? $dashboards[$id] : null );
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2>Dashboards</h2>
        </div>
    </div>
    <div class="col-xs-8">
        <?php foreach ($dashboards as $dashboard):?>
            <?php echo CHtml::link(
                CHtml::encode($dashboard->name),
                array('dashboard/index','id'=>$dashboard->id),
                array('class'=>'btn btn-primary'.($dashboard->id == $id ? ' active' : ''))
            );?>
        <?php endforeach;?>
        <?php echo CHtml::link(
            '+',
            array('dashboard/create'),
            array('class'=>'btn btn-primary')
        );?>
    </div>
    <div class="col-xs-4 text-right">
        <?php if ($selectedDashboard):?>
            <?php echo CHtml::link(
                'Добавить виджет',
                array('dashboard/createWidget','id'=>$selectedDashboard->id),
                array('class'=>'btn btn-primary')
            );?>
        <?php endif;?>
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <?php if ($selectedDashboard): ?>
        <?php $row = 0;?>
        <div class="row">
            <?php foreach ($selectedDashboard->dashboardSystemModules as $dashboardSystemModule ):?>
                <?php if ($row + $dashboardSystemModule->rows > 12):?>
                    </div>
                    <div class="row">
                    <?php $row = 0;?>
                <?php endif;?>
                <div class="col-md-<?php echo $dashboardSystemModule->rows;?> panel-dragtable">
                    <?php echo $dashboardSystemModule;?>
                </div>
                <?php $row +=$dashboardSystemModule->rows ;?>
            <?php endforeach;?>
        </div>
    <?php else:?>
        <div class="widget red-bg p-lg text-center col-xs-4">
            <div class="m-b-md">
                <i class="fa fa-bell fa-4x"></i>
                <h3 class="font-bold">Dashboard not found</h3>
                <br>
                <?php echo CHtml::link(
                    'Create dashboard',
                    array('dashboard/create'),
                    array('class'=>'btn btn-white btn-xs text-danger')
                );?>
            </div>
        </div>
    <?php endif;?>
</div>