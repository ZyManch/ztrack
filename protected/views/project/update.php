<?php
/* @var $this ProjectController */
/* @var $model Project */



?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2><?php echo $model->title; ?></h2>
        </div>
    </div>
</div>



<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-xs-12">
            <div class="ibox ">
                <div class="ibox-content">

                <?php $this->renderPartial('_form', array('model'=>$model)); ?>
                </div>
            </div>
        </div>
    </div>

    <?php $this->renderPartial('//project/settings/_view', array('project'=>$model,'groups'=>$groups,'modules' => $modules)); ?>

</div>