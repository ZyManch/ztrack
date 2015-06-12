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
            <h2>Search in wiki: <?php echo CHtml::encode($search_query);?></h2>
        </div>
    </div>

    <div class="wrapper wrapper-content  animated fadeInRight">


        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$dataProvider,
            'template'=>'{items} {summary} {pager}',
            'itemsCssClass' => 'table table-hover',
            'htmlOptions' => array('class'=>'project-list'),
            'columns'=>array(
                array(
                    'name' => 'project_id',
                    'htmlOptions' => array('style'=>'width:200px'),
                    'headerHtmlOptions' => array('class'=>''),
                    'type' => 'raw',
                    'value' => function(Page $page) {
                        return CHtml::link(
                            CHtml::encode($page->project->title),
                            array('project/view','id'=>$page->project->id)
                        );
                    }
                ),
                array(
                    'name' => 'title',
                    'htmlOptions' => array('class'=>'project-title'),
                    'headerHtmlOptions' => array('class'=>''),
                    'type' => 'raw',
                    'value' => function(Page $page) {
                        return CHtml::link(
                            $page->getTitle(),
                            array(
                                'project/view',
                                'id'=>$page->project_id,
                                'module'=>'wiki',
                                'action'=>'view',
                                'wiki'=>$page->url
                            )
                        );
                    }
                )
            )
        ));?>
    </div>
</div>