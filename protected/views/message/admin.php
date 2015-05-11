<?php
/* @var $this MessageController */
/* @var $model Message */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#message-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>Messages</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">

        <p>
        You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
        or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>

        <?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
        <div class="search-form" style="display:none">
        <?php $this->renderPartial('_search',array(
            'model'=>$model,
        )); ?>
        </div><!-- search-form -->

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'message-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'template'=>'{items} {summary} {pager}',
            'itemsCssClass' => 'table table-hover',
            'htmlOptions' => array('class'=>'project-list'),
            'columns'=>array(
        		'id',
		'user_id',
		'body',
		'status',
		'changed',
                array(
                    'class'=>'CButtonColumn',
                ),
            ),
        )); ?>
    </div>
</div>