<?php
/* @var $this StatisticController */
/* @var $model Statistic */
//$graphData = new GraphData($model->name,$model->getLastPoints(10));
//$graph = new ChartLineGraph();
//$graph->addData($graphData);

?>
<div class="row">
    <div class="col-xs-12">
        <div class="row wrapper border-bottom white-bg page-heading">
            <h1><?php echo CHtml::encode($model->name); ?></h1>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins col-xs-12">
        <div class="ibox-content">
            <div>
                <?php //echo $graph->render(array('height'=>100,'style'=>'height:100px'));?>
            </div>
        </div>
    </div>
</div>
