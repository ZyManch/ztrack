<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 05.04.2015
 * Time: 22:46
 * @var AbstractWidgetModule $systemModule
 * @var Dashboard $dashboard
 * @var DashboardController $this
 * @var DashboardSystemModule $dashboardSystemModule
 */
?>
<div class="wrapper wrapper-content ">
    <div class="col-xs-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add widget to <?php echo CHtml::encode($dashboard->name);?></h5>
            </div>
            <div class="ibox-content">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'config-form',
                    'enableAjaxValidation'=>false,
                    'htmlOptions' => array('class'=>'form-horizontal')
                )); ?>
                <?php echo $this->renderPartial('//dashboard/_widgetForm',array(
                    'dashboardSystemModule' => $dashboardSystemModule
                ));?>
                <div class="hr-line-dashed clear"></div>
                <div class="row">
                    <?php $systemModule->renderConfigure($form, null);?>
                </div>


                <div class="hr-line-dashed clear"></div>
                <div class="text-center">
                    <?php echo CHtml::link(
                        'Cancel',
                        array('dashboard/index','id'=>$dashboard->id),
                        array('class'=>'btn btn-white')
                    );?>
                    <?php echo CHtml::link(
                        'Choice another widget',
                        array('dashboard/createWidget','id'=>$dashboard->id),
                        array('class'=>'btn btn-white')
                    );?>

                    <?php echo CHtml::submitButton('Create widget',array('class'=>'btn btn-primary')); ?>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>