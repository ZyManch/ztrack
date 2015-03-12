<?php
/* @var $this NotesController */
/* @var $model Page */


?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2>My notes</h2>
        </div>

        <?php $this->renderPartial('_form', array('model'=>$model,'top_id'=>$top_id)); ?>

    </div>
</div>
