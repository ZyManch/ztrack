<?php
/* @var $this StatisticController */
/* @var $model Statistic */



?>
<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>View Statistic #<?php echo $model->id; ?></h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
        		'id',
		'company_id',
		'name',
		'status',
		'changed',
            ),
        )); ?>
    </div>
</div>
