<?php
/* @var $this ErrorController */
/* @var $model Error */



?>
<div class="wrapper wrapper-content">
    <div class="col-xs-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Edit Error <?php echo $model->id; ?></h5>
            </div>
            <div class="ibox-content">
                <?php $this->renderPartial('_form', array('model'=>$model)); ?>            </div>
        </div>
    </div>
</div>