<?php
/* @var $this ErrorController */
/* @var $model SearchError */


?>

<div class="row wrapper border-bottom white-bg page-heading">
    <h2>Errors</h2>
    <div class="ibox-tools">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-xs-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Errors</h5>
                </div>
                <div class="ibox-content">

                    <?php $this->renderPartial('//error/_list',array('model'=>$model));?>
                </div>
            </div>
        </div>
    </div>
</div>