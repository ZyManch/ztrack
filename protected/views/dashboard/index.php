<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 10:28
 * @var Dashboard[] $dashboards
 * @var int $id
 */
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
    <div class="col-xs-12">
        <?php if ($selectedDashboard): ?>
            <?php foreach ($selectedDashboard->dashboardSystemModules as $dashboardSystemModule ):?>
                <?php echo $dashboardSystemModule;?>
            <?php endforeach;?>
            <div class="widget navy-bg p-lg text-center  col-xs-2">
                <div class="m-b-md">
                    <i class="fa fa-plus fa-4x"></i>
                    <br>
                    <?php echo CHtml::link(
                        'Add widget',
                        array('dashboard/createWidget','id'=>$selectedDashboard->id),
                        array('class'=>'btn btn-white btn-xs text-success')
                    );?>
                </div>
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
</div>