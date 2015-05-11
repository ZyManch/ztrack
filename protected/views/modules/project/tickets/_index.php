<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 13:26
 * @var $this Controller
 * @var $second_widget AbstractWidgetModule
 * @var $my_tickets_widget TicketsWidgetModule
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content text-right">
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
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>My tickets</h5>
            </div>
            <div class="ibox-content">
                <?php $my_tickets_widget->renderWidget();?>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php echo $second_widget->getTitle();?></h5>
            </div>
            <div class="ibox-content">
                <?php $second_widget->renderWidget();?>
            </div>
        </div>
    </div>
</div>