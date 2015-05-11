<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 05.04.2015
 * Time: 22:46
 * @var DashboardSystemModule $dashboardSystemModule
 * @var AbstractWidgetModule $systemModule
 * @var DashboardController $this
 */
$systemModule = $dashboardSystemModule->systemModule;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2><?php echo $systemModule->getTitle();?></h2>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Configuration</h5>
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
                <div class="hr-line-dashed"></div>
                <?php $systemModule->renderConfigure(
                    $form,
                    $dashboardSystemModule->params ?
                        json_decode($dashboardSystemModule->params,1):
                        null
                );?>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <?php echo CHtml::link(
                            'Cancel',
                            array('dashboard/cancel','id'=>$dashboardSystemModule->dashboard_id),
                            array('class'=>'btn btn-white')
                        ); ?>
                        <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-primary')); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>