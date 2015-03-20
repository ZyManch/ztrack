<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 20.03.2015
 * Time: 14:05
 * @var $dataProvider CActiveDataProvider
 */
?>
<div class="feed-activity-list">
    <?php $this->widget('LightListView', array(
        'dataProvider'=>$dataProvider,
        'template' => '{items}{summary}{sorter}{pager}',
        'itemView'=>'//modules/project/tickets/_historyItem',
    )); ?>
</div>