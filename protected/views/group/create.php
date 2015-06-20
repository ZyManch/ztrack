<?php
/* @var $this GroupController */
/* @var $model Group */


?>

<div class="wrapper wrapper-content">
    <div class="col-xs-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Создание Group</h5>
            </div>
            <div class="ibox-content">
                <?php $this->renderPartial('_form', array('model'=>$model)); ?>            </div>
        </div>
    </div>
</div>

