<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 12:23
 * @var StatisticWidgetModule $system_module
 * @var DashboardController $this
 * @var Statistic $statistic
 */
Yii::app()->clientScript->registerScript(
    'config-statistics',
    '$("#config-statistics").change(function() {
        $(".statistic").hide();
        $("#statistic-"+$(this).val()).show();
    });'
);
?>
<div class="form-group">
    <?php echo CHtml::label(
        'Statistic',
        'config-statistics',
        array('class'=>'col-sm-3 control-label')
    ); ?>
    <div class="col-sm-9">
        <?php echo CHtml::dropDownList(
            'config[statistic_id]',
            isset($config['statistic_id']) ? $config['statistic_id'] : null,
            CHtml::listData(Yii::app()->user->getUser()->getAvailableStatistics(),'id','name'),
            array('class'=>'form-control','id'=>'config-statistics','empty'=>'')
        ); ?>
    </div>
</div>