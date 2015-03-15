<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 13:26
 * @var $this Controller
 * @var $second_widget AbstractWidgetModule
 * @var $my_tickets_widget UserTicketsWidgetModule
 */
?>
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                asd
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Мои тикеты</h5>
            </div>
            <div class="ibox-content">
                <?php $my_tickets_widget->draw();?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <?php if ($second_widget instanceof LastReleaseWidgetModule):?>
                    <h5>Текущий <?php echo $second_widget->getLastRelease()->getTitle();?></h5>
                <?php else:?>
                    <h5>Текущий список задач</h5>
                <?php endif;?>
            </div>
            <div class="ibox-content">
                <?php $second_widget->draw();?>
            </div>
        </div>
    </div>
</div>