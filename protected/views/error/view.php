<?php
/* @var $this ErrorController */
/* @var $model Error */
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-md-6">
            <?php $this->renderPartial('//error/_widgets/_info',array('error'=>$model));?>
            <?php $this->renderPartial('//error/_widgets/_tickets',array('error'=>$model));?>
        </div>
        <div class="col-md-6">
            <?php $this->renderPartial('//error/_widgets/_geo',array('error'=>$model));?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <?php $this->renderPartial('//error/_widgets/_requests',array('error'=>$model));?>
        </div>
    </div>

    <?php if ($model->lastRequest->traces):?>
        <div class="row">
            <div class="col-xs-12">
                <?php $this->renderPartial('//error/_widgets/_trace',array('request'=>$model->lastRequest));?>
            </div>
        </div>
    <?php endif;?>
</div>

