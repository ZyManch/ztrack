<?php
/* @var $this StatisticController */
/* @var $data Statistic */
//$graphData = new GraphData($data->name,$data->getLastPoints(10));
//$graph = new ChartLineGraph();
//$graph->addData($graphData);
?>

<div class="ibox float-e-margins col-xs-6">
    <div class="ibox-title">
        <h5><?php echo CHtml::encode($data->name);?></h5>
        <div class="ibox-tools">
            <?php echo CHtml::link(
                'View',
                array('view', 'id'=>$data->id),
                array('class'=>'btn btn-primary btn-xs')
            ); ?>
        </div>
    </div>
    <div class="ibox-content">
        <div>
            <?php //echo $graph->render(array('height'=>100,'style'=>'height:100px'));?>
        </div>
    </div>
</div>

