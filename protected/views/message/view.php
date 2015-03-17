<?php
/* @var $this MessageController */
/* @var $model Message */



?>
<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>View Message #<?php echo $model->id; ?></h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
        		'id',
		'user_id',
		'body',
		'status',
		'changed',
            ),
        )); ?>
    </div>
</div>
