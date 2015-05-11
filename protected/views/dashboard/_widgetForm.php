<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 08.04.2015
 * Time: 11:03
 * @var DashboardSystemModule $dashboardSystemModule
 * @var DashboardController $this
 */
?>
<div class="form-group">
    <?php echo CHtml::label(
        'Widget name',
        'widget-title',
        array('class'=>'col-sm-3 control-label')
    ); ?>
    <div class="col-sm-9">
        <?php echo CHtml::textField(
            'widget[title]',
            $dashboardSystemModule->title,
            array('class'=>'form-control','id'=>'widget-title')
        ); ?>
    </div>
</div>
<div class="form-group">
    <?php echo CHtml::label(
        'Widget size',
        'widget-rows',
        array('class'=>'col-sm-3 control-label')
    ); ?>
    <div class="col-sm-9">
        <?php echo CHtml::numberField(
            'widget[rows]',
            $dashboardSystemModule->rows,
            array('class'=>'form-control','min'=>1,'max'=>12,'id'=>'widget-rows')
        ); ?>
    </div>
</div>
<div class="form-group">
    <?php echo CHtml::label(
        'Widget type',
        'widget-type',
        array('class'=>'col-sm-3 control-label')
    ); ?>
    <div class="col-sm-9">
        <?php echo CHtml::dropDownList(
            'widget[type]',
            $dashboardSystemModule->type,
            DashboardSystemModule::getTypeVariants(),
            array('class'=>'form-control','id'=>'widget-type')
        ); ?>
    </div>
</div>