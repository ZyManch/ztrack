<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 05.04.2015
 * Time: 22:51
 * @var $system_module AbstractWidgetModule
 * @var $config Array
 * @var $form CActiveForm
 */
$projectIds = array_keys(Yii::app()->user->getUser()->getAvailableProjects());
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
<div class="form-group">
    <?php echo CHtml::label(
        'Projects',
        'config-projects',
        array('class'=>'col-sm-3 control-label')
    ); ?>
    <div class="col-sm-9">
        <?php echo CHtml::dropDownList(
            'config[projects]',
            isset($config['projects']) ? $config['projects'] : array(),
            Project::getProjectsAsList($projectIds),
            array('class'=>'form-control','id'=>'config-projects','multiple'=>'multiple')
        ); ?>
    </div>
</div>