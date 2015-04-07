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
            <div class="ibox-content">

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Мои тикеты</h5>
            </div>
            <div class="ibox-content">
                <?php $my_tickets_widget->draw();?>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?php echo $second_widget->getTitle();?></h5>
            </div>
            <div class="ibox-content">
                <?php $second_widget->draw();?>
            </div>
        </div>
    </div>
</div>