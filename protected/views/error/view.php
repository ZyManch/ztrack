<?php
/* @var $this ErrorController */
/* @var $model Error */



?>
<div class="wrapper wrapper-content">
    <div class="col-xs-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php echo CHtml::encode($model->title); ?></h5>
            </div>
            <div class="ibox-content">
                <?php $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'attributes'=>array(
                		'id',
		'title',
		'hash',
		'level_id',
		'project_id',
		'branch_id',
		'total_count',
		'trace_file',
		'trace_line',
		'status',
		'changed',
                ),
                )); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Система</h5>
            </div>
            <div class="ibox-content">
                <?php
                $oss = $model->getGroupedOs();
                $graph = new FlotPieGraph();
                foreach ($oss as $os) {
                    $graph->addData(new GraphData($os->os,array($os->count)));
                }
                echo $graph->render(array('style'=>'width:100%;height:200px'));
                ?>
            </div>
        </div>
    </div>
</div>

