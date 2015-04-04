<?php
/* @var $this StatisticController */
/* @var $data Statistic */
$clientScript = Yii::app()->clientScript;
$clientScript->registerScriptFile('/js/Chart.min.js');
$id = 'statistic-'.$data->id;
$points = $data->getLastPoints(10);
$clientScript->registerScript($id,sprintf('
    var lineData = %s;
    var lineOptions = {
        scaleShowGridLines: true,
        scaleGridLineColor: "rgba(0,0,0,.05)",
        scaleGridLineWidth: 1,
        bezierCurve: true,
        bezierCurveTension: 0.4,
        pointDot: true,
        pointDotRadius: 4,
        pointDotStrokeWidth: 1,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 2,
        datasetFill: true,
        responsive: true
    };
    var ctx = document.getElementById("%s").getContext("2d");
    var myNewChart = new Chart(ctx).Line(lineData, lineOptions);
    ',
    json_encode(array(
        'labels' => array_keys($points),
        'datasets' => array(array(
            'label' => $data->name,
            'fillColor' => 'rgba(26,179,148,0.5)',
            'strokeColor' => 'rgba(26,179,148,0.7)',
            'pointColor' => 'rgba(26,179,148,1)',
            'pointStrokeColor' => '#fff',
            'pointHighlightFill' => '#fff',
            'pointHighlightStroke' => 'rgba(26,179,148,1)',
            'data' => array_values($points)
        ))
    )),
    $id
),CClientScript::POS_LOAD);
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
            <canvas id="<?php echo $id;?>" height="150px"></canvas>
        </div>
    </div>
</div>

