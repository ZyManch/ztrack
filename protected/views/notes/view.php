<?php
/* @var $this NotesController */
/* @var $model Page */



?>
<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>View Page #<?php echo $model->id; ?></h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
        		'id',
		'author_user_id',
		'assign_user_id',
		'page_type_id',
		'project_id',
		'url',
		'title',
		'body',
		'status',
		'changed',
            ),
        )); ?>
    </div>
</div>
