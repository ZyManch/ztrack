<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 17.03.2015
 * Time: 14:41
 * @var $dataProvider CActiveDataProvider
 */
?>
<div class="feed-activity-list">
    <?php $this->renderPartial('//comments/_create');?>
    <?php $this->widget('LightListView', array(
        'dataProvider'=>$dataProvider,
        'template' => '{items}{summary}{sorter}{pager}',
        'itemView'=>'//comments/_view',
    )); ?>

</div>