<?php
/* @var $this TicketController */
/* @var $model TicketPage */


?>

<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-9">
                 <h1>Create ticket</h1>
                </div>
                <div class="col-md-3 text-right">

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <?php $this->renderPartial('//modules/project/tickets/_form', array('model'=>$model)); ?>    </div>
                </div>
            </div>
        </div>
    </div>
</div>
