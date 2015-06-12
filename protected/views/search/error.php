<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 12.06.2015
 * Time: 15:58
 * @var $search_query
 * @var CActiveDataProvider $dataProvider
 */
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2>Search in errors: <?php echo CHtml::encode($search_query);?></h2>
        </div>
    </div>

    <div class="wrapper wrapper-content  animated fadeInRight">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'request-grid',
            'dataProvider'=>$dataProvider,
            'template'=>'{items} {summary} {pager}',
            'itemsCssClass' => 'table table-hover',
            'htmlOptions' => array('class'=>''),
            'columns'=>array(
                array(
                    'name' => 'level_id',
                    'type'=>'raw',
                    'value' => function (Request $model) {
                        return CHtml::tag(
                            'div',
                            array('class'=>'label '.($model->error->level->css_class ? $model->error->level->css_class : 'label-danger')),
                            CHtml::encode($model->error->level->title)
                        );
                    },
                    'htmlOptions' => array('style' => 'width:70px')
                ),
                array(
                    'name' => 'code',
                    'htmlOptions' => array('style' => 'max-width:120px'),
                ),
                array(
                    'name' => 'title',
                    'type' => 'raw',
                    'value' => function(Request $model) {
                        return CHtml::link(
                            CHtml::encode($model->error->title),
                            array('error/view','id'=>$model->id)
                        );
                    },
                    'htmlOptions' => array('style' => 'min-width:200px')
                ),
                array(
                    'header' => 'Branch',
                    'value' => function(Request $model) {
                        return $model->error->branch ? $model->error->branch->title : '-';
                    },
                    'htmlOptions' => array('style' => 'width:70px')
                ),
                array(
                    'header' => 'Domain',
                    'type' => 'raw',
                    'value' => function (Request $model) {
                        if (!$model->url->domain) {
                            return null;
                        }
                        return CHtml::link(
                            CHtml::encode($model->url->domain),
                            $model->url->protocol.'://'.$model->url->domain.$model->url->url,
                            array('target'=>'_top')
                        );
                    },
                    'htmlOptions' => array('style' => 'width:175px')
                ),
                array(
                    'name' => 'changed',
                    'value' => function(Request $model) {
                        $timestamp = strtotime($model->changed);
                        $today = strtotime(date('Y-m-d 00:00:00'));
                        return Yii::app()->dateFormatter->formatDateTime(
                            $timestamp,
                            $timestamp < $today ? 'short' : false,
                            'medium'
                        );
                    },
                    'htmlOptions' => array('style' => 'width:70px')
                ),
                array(
                    'class'=>'CButtonColumn',
                    'htmlOptions' => array('style' => 'width:70px')
                ),
            ),
        )); ?>
    </div>
</div>