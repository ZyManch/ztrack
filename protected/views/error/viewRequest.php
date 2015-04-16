<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.04.2015
 * Time: 14:10
 * @var Request $model
 * @var ErrorController $this
 */
$error = $model->error;
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-md-6">
            <?php $this->renderPartial('//error/_widgets/_info',array('error'=>$error,'request'=>$model));?>
        </div>
        <div class="col-md-6">
            <?php $this->renderPartial('//error/_widgets/_context',array('request'=>$model,'maxLength'=>120,'shortMode'=>true));?>
        </div>
    </div>
    <?php if ($model->traces):?>
        <div class="row">
            <div class="col-xs-12">
                <?php $this->renderPartial('//error/_widgets/_trace',array('request'=>$model));?>
            </div>
        </div>
    <?php endif;?>
    <div class="row">
        <div class="col-xs-12">
            <?php $this->renderPartial('//error/_widgets/_context',array('request'=>$model,'minLength'=>120,'shortMode'=>false));?>
        </div>
    </div>
</div>

