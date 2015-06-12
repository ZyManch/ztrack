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
            <h2>Search in tickets: <?php echo CHtml::encode($search_query);?></h2>
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
                    'name' => 'id',
                    'htmlOptions' => array('class'=>'project-status','style'=>'width:50px'),
                    'headerHtmlOptions' => array('class'=>''),
                    'type' => 'raw',
                    'value' => function(Page $page) {
                        return CHtml::tag(
                            'span',
                            array('class'=>'label label-'.$page->getCssClass()),
                            $page->id
                        );
                    }
                ),
                array(
                    'name' => 'project_id',
                    'htmlOptions' => array('class'=>'project-title'),
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
                        if ($page->getProgressValue() == 100) {
                            $title = CHtml::tag('strike',array(),CHtml::encode($page->getTitle()));
                        } else {
                            $title = CHtml::encode($page->getTitle());
                        }
                        $title = CHtml::link(
                            $title,
                            array(
                                'project/view',
                                'id'=>$page->project_id,
                                'module'=>'tickets',
                                'action'=>'view',
                                'ticket_id'=>$page->id
                            )
                        );
                        if (!$page->parent_page_id) {
                            return $title;
                        }
                        return $title.
                        CHtml::tag('br').
                        CHtml::tag('small',
                            array(),
                            implode(' > ', $page->getParentsList(true))
                        );
                    }
                ),
                array(
                    'name' => 'progress',
                    'htmlOptions' => array('class'=>'project-completion','style'=>'width:50px'),
                    'headerHtmlOptions' => array('class'=>''),
                    'type' => 'raw',
                    'value' => function(Page $page) {
                        return CHtml::tag('small',array(),''.$page->getProgressValue().'%').
                        CHtml::tag(
                            'div',
                            array('class'=>'progress progress-mini'),
                            CHtml::tag('div',array('class'=>'progress-bar','style'=>'width:'.$page->progress.'%'))
                        );
                    }
                ),

                array(
                    'header' => 'Autor',
                    'name' => 'author_user_id',
                    'type' => 'raw',
                    'htmlOptions' => array('class'=>'project-people','style'=>'width:40px'),
                    'value' => function(Page $page) {
                        return $page->authorUser->getGravatarLink(32);
                    }
                ),
                array(
                    'header' => 'Assign',
                    'name' => 'assign_user_id',
                    'type' => 'raw',
                    'htmlOptions' => array('class'=>'project-people','style'=>'width:40px'),
                    'value' => function(Page $page) {
                        if (!$page->assignedUserPage) {
                            return '&nbsp;';
                        }
                        return $page->assignedUserPage->user->getGravatarLink(32);
                    }
                ),
            )
        ));?>
    </div>
</div>