<?php
/* @var $this DashboardController */
/* @var $model Dashboard */


?>


<div class="wrapper wrapper-content ">
    <div class="col-xs-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Create new Dashboard</h5>
            </div>
            <div class="ibox-content">
                <?php $this->renderPartial('_form', array('model'=>$model)); ?>
            </div>
        </div>
    </div>
</div>