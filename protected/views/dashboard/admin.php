<?php
/* @var $this DashboardController */
/* @var $model Dashboard */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#dashboard-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<div class="row wrapper border-bottom white-bg page-heading">
    <h2> Dashboards</h2>
    <div class="ibox-tools">
        <?php echo CHtml::link('Advanced Search','#',array('class'=>'btn btn-primary btn-xs search-button')); ?>    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-xs-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Dashboards</h5>
                </div>
                <div class="ibox-content">
                    <p>
                    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
                    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
                    </p>



                    <div class="search-form" style="display:none">
                    <?php $this->renderPartial('_search',array(
                        'model'=>$model,
                    )); ?>
                    </div><!-- search-form -->

                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'dashboard-grid',
                        'dataProvider'=>$model->search(),
                        'filter'=>$model,
                        'template'=>'{items} {summary} {pager}',
                        'itemsCssClass' => 'table table-hover',
                        'htmlOptions' => array('class'=>'project-list'),
                        'columns'=>array(
                    		'id',
		'user_id',
		'project_id',
		'name',
		'position',
		'status',
		/*
		'changed',
		*/
                            array(
                                'class'=>'CButtonColumn',
                            ),
                        ),
                    )); ?>
                </div>
            </div>
        </div>
    </div>
</div>