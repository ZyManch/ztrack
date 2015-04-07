<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 10:28
 * @var Dashboard[] $dashboards
 * @var int $id
 */
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
    <div class="col-xs-2 text-right">
        <?php echo CHtml::link(
            'Добавить виджет',
            array('dashboard/createWidget','id'=>$dashboard->id),
            array('class'=>'btn btn-primary')
        );?>
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="col-xs-12">
        <?php if ($id && isset($dashboards[$id])): ?>
            <?php foreach ($dashboards[$id]->dashboardSystemModules as $dashboardSystemModule ):?>
                <?php echo $dashboardSystemModule;?>
            <?php endforeach;?>
        <?php else:?>
            <div class="stat-panel">
                <div class="stat-cell bg-danger valign-middle">
                    Dashboard not found
                </div>
            </div>
        <?php endif;?>
    </div>
</div>