<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 05.04.2015
 * Time: 22:51
 */
?>
<div class="form-group">
    <?php echo CHtml::label(
        'Тип графика',
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
<div class="form-group">
    <?php echo CHtml::label(
        'Статистика',
        'config-statistics',
        array('class'=>'col-sm-3 control-label')
    ); ?>
    <div class="col-sm-9">
        <?php echo CHtml::dropDownList(
            'config[statistics]',
            isset($config['statistics']) ? $config['statistics'] : array(),
            CHtml::listData(Yii::app()->user->getUser()->getAvailableStatistics(),'id','title'),
            array('class'=>'form-control','id'=>'config-projects','multiple'=>'multiple')
        ); ?>
    </div>
</div>
<div class="form-group">
    <?php echo CHtml::label(
        'Количество данных',
        'config-count',
        array('class'=>'col-sm-3 control-label')
    ); ?>
    <div class="col-sm-9">
        <?php echo CHtml::numberField(
            'config[count]',
            isset($config['count']) ? $config['count'] : 10,
            array('class'=>'form-control','id'=>'config-count','min'=>1,'max'=>50)
        ); ?>
    </div>
</div>