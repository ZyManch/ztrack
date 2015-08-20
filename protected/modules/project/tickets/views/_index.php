<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 13:26
 * @var $this Controller
 * @var $widgets array
 */
$selectedWidgetConfig = $widgets[0];
$selected = Yii::app()->request->getParam('widget');
foreach ($widgets as $widgetConfig) {
    if ($widgetConfig['name']==$selected) {
        $selectedWidgetConfig = $widgetConfig;
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-8">
                        Show ticket list:
                        &nbsp;
                        <div class="btn-group">
                            <?php foreach ($widgets as $widgetConfig):?>
                                <?php echo CHtml::link(
                                    $widgetConfig['label'],
                                    array(
                                        'project/view',
                                        'id' => Yii::app()->request->getParam('id'),
                                        'module'=>'tickets',
                                        'action'=>'index',
                                        'widget' => $widgetConfig['name']
                                    ),
                                    array(
                                        'class'=>'btn btn-white'.($widgetConfig['name']==$selectedWidgetConfig['name']?' active':'')
                                    )
                                );?>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <?php echo CHtml::link(
                            'Create ticket',
                            array(
                                'project/view',
                                'id' => Yii::app()->request->getParam('id'),
                                'module'=>'tickets',
                                'action'=>'create'
                            ),
                            array(
                                'class'=>'btn btn-primary'
                            )
                        );?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php $selectedWidgetConfig['widget']->renderWidget();?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>