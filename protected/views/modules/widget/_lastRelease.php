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
    'columns'=>array(
        array(
            'name' => 'title',
            'htmlOptions' => array('class'=>'project-title'),
            'headerHtmlOptions' => array('class'=>''),
            'value' => function(Page $page) {
                return $page->title;
            }
        ),
        array(
            'name' => 'title',
            'value' => function(Page $page) {
                return $page->title;
            }
        ),
    )
));?>