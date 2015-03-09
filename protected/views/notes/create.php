<?php
/* @var $this NotesController */
/* @var $model Page */


?>

<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>Создание Page</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>    </div>
</div>
