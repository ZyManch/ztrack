<?php
/* @var $this NotesController */
/* @var $model Page */



?>
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>Edit note <?php echo $model->id; ?></h1>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-xs-12">

        <?php $this->renderPartial('_form', array('model'=>$model,'top_id'=>$top_id)); ?>
    </div>
</div>