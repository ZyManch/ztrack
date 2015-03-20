<?php
/* @var $this TicketController */
/* @var $model TicketPage */

$parent = $model->parentPage;

?>
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-9">
                        <h1>[#<?php echo $model->id;?>] <?php echo CHtml::encode($model->getTitle());?></h1>
                    </div>
                    <div class="col-md-3 text-right">
                        <?php echo CHtml::link('View',array(
                            'project/view',
                            'id' =>$model->project_id,
                            'module'=>'tickets',
                            'action'=>'view',
                            'ticket_id'=>$model->id
                        ),array('class'=>'btn btn-primary'));?>
                        <?php if ($model->status != Page::STATUS_CLOSED):?>
                            <?php echo CHtml::link('Close',array(
                                'project/view',
                                'id' =>$model->project_id,
                                'module'=>'tickets',
                                'action'=>'changeStatus',
                                'status' => 'Closed',
                                'ticket_id'=>$model->id
                            ),array('class'=>'btn btn-danger'));?>
                        <?php else:?>
                            <?php echo CHtml::link('Reopen',array(
                                'project/view',
                                'id' =>$model->project_id,
                                'module'=>'tickets',
                                'action'=>'changeStatus',
                                'status' => 'Active',
                                'ticket_id'=>$model->id
                            ),array('class'=>'btn btn-info'));?>
                        <?php endif;?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <?php $this->renderPartial('//modules/project/tickets/_form', array('model'=>$model)); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>