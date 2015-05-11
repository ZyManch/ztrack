<?php
/* @var $this StatisticController */
/* @var $model Statistic */



?>
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>Update Statistic <?php echo $model->id; ?></h1>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-xs-12">

        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>