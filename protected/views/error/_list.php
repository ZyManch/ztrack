<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.04.2015
 * Time: 16:10
 * @var SearchError $model
 */
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'error-grid',
    'dataProvider'=>$model->search(),
    'template'=>'{items} {summary} {pager}',
    'itemsCssClass' => 'table table-hover',
    'htmlOptions' => array('class'=>'project-list'),
    'columns'=>array(
        array(
            'name' => 'project_id',
            'visible' => !$model->project_id || is_array($model->project_id),
            'value' => function(Error $model) {
                return $model->project ? $model->project->title : '-';
            }
        ),
        array(
            'name'=>'total_count',
            'type' => 'raw',
            'value'=>function(Error $model) {
                return CHtml::tag(
                    'div',
                    array(
                        'class'=>$model->total_count > 500 ?
                            'text-danger' :
                            ($model->total_count > 50 ? 'text-warning' : '')
                    ),
                    $model->total_count
                );
            }
        ),
        array(
            'name' => 'level_id',
            'type'=>'raw',
            'value' => function (Error $model) {
                return CHtml::tag(
                    'div',
                    array('class'=>'label '.($model->level->css_class ? $model->level->css_class : 'label-danger')),
                    CHtml::encode($model->level->title)
                );
            }
        ),
        array(
            'name' => 'title',
            'type' => 'raw',
            'value' => function(Error $model) {
                return CHtml::link(
                    CHtml::encode($model->title),
                    array('error/view','id'=>$model->id)
                );
            }
        ),
        array(
            'name' => 'branch_id',
            'value' => function(Error $model) {
                return $model->branch ? $model->branch->title : '-';
            }
        ),
        array(
            'name' => 'changed',
            'value' => function(Error $model) {
                $timestamp = strtotime($model->changed);
                $today = strtotime(date('Y-m-d 00:00:00'));
                return Yii::app()->dateFormatter->formatDateTime(
                    $timestamp,
                    $timestamp < $today ? 'short' : false,
                    'medium'
                );
            }
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>