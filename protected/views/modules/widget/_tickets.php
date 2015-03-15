<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 14.03.2015
 * Time: 23:15
 * @var $provider CActiveDataProvider
 */

?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$provider,
    'template'=>'{items} {summary} {pager}',
    'itemsCssClass' => 'table table-hover table-bordered',
    'rowCssClassExpression' => function($row, Page $page) {
        return $page->getCssClass();
    },
    'htmlOptions' => array('class'=>'project-list'),
    'columns'=>array(
        array(
            'name' => 'id',
            'htmlOptions' => array('class'=>''),
            'headerHtmlOptions' => array('class'=>''),
            'value' => function(Page $page) {
                return $page->id;
            }
        ),
        array(
            'name' => 'title',
            'htmlOptions' => array('class'=>'project-title'),
            'headerHtmlOptions' => array('class'=>''),
            'value' => function(Page $page) {
                return $page->title;
            }
        ),
        array(
            'name' => 'author_user_id',
            'htmlOptions' => array('class'=>'project-people'),
            'value' => function(Page $page) {
                return $page->author_user_id;
            }
        ),
    )
));?>