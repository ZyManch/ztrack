<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 12:21
 * @var StatisticWidgetModule $system_module
 * @var Statistic $statistic
 */
?>
<div class="form-group">
    <?php echo CHtml::label(
        'Graph type',
        'config-graph-id',
        array('class'=>'col-sm-3 control-label')
    ); ?>
    <div class="col-sm-9">
        <?php echo CHtml::dropDownList(
            'config[graph_id]',
            isset($config['graph_id']) ? $config['graph_id'] : GRAPH_CHART_LINE,
            Graph::getVariants(),
            array('class'=>'form-control','id'=>'config-graph-id')
        ); ?>
    </div>
</div>