<?php
/* @var $this StatisticController */
/* @var $model Statistic */


?>
<div class="row wrapper border-bottom white-bg page-heading">
    <h2>Statistics</h2>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

                    <?php $this->widget('zii.widgets.CListView', array(
                        'itemView'=>'//statistic/_view',
                        'dataProvider'=>$model->search(),
                    )); ?>
</div>