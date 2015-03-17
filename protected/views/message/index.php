<?php
/* @var $this MessageController */
/* @var $dataProvider CActiveDataProvider */


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

        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
        )); ?>
    </div>
</div>
