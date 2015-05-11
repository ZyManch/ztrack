<?php
/* @var $this TicketController */
/* @var $model TicketPage */

$parent = $model->parentPage;
Yii::app()->clientScript->registerCssFile('/css/custom.css');

?>
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-8">
                        <h1>[#<?php echo $model->id;?>] <?php echo CHtml::encode($model->getTitle());?></h1>
                        <?php if ($model->parent_page_id):?>
                            <?php echo implode(' > ', $model->getParentsList(true));?>
                        <?php endif;?>
                        <hr>
                    </div>
                    <div class="col-md-4 text-right">
                        <?php echo CHtml::link('Create sub ticket',array(
                            'project/view',
                            'id' =>$model->project_id,
                            'module'=>'tickets',
                            'action'=>'create',
                            'ticket_id'=>$model->id
                        ),array('class'=>'btn btn-warning'));?>
                        <?php echo CHtml::link('Edit',array(
                            'project/view',
                            'id' =>$model->project_id,
                            'module'=>'tickets',
                            'action'=>'update',
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
                <div class="row">
                    <div class="col-sm-4 col-lg-2 text-center">
                        <div class="list-group">
                            <?php echo $this->renderPartial('//modules/project/tickets/_ticketUsers',array('model'=>$model));?>
                        </div>
                    </div>
                    <div class="col-sm-8 col-lg-10">

                        <div class="row">
                            <div class="col-lg-6">
                                <dl class="dl-horizontal">
                                    <dt>Author</dt>
                                    <dd>
                                        <?php echo $model->authorUser;?>
                                    </dd>
                                    <dt>Created</dt>
                                    <dd>
                                        <?php echo Yii::app()->dateFormatter->diff(strtotime($model->created));?>
                                    </dd>
                                    <dt>Changed</dt>
                                    <dd>
                                        <?php echo Yii::app()->dateFormatter->diff(strtotime($model->changed));?>
                                    </dd>
                                </dl>
                            </div>
                            <div class="col-lg-6">
                                <dl class="dl-horizontal">
                                    <dt>Level</dt>
                                    <dd>
                                        <span>
                                            <?php echo $model->level->title;?>
                                        </span>
                                    </dd>
                                    <dt>Status</dt>
                                    <dd>
                                        <?php echo $model->status;?>
                                    </dd>
                                    <dt>Progress</dt>
                                    <dd>
                                        <div class="progress progress-striped active m-b-sm">
                                            <div class="progress-bar" style="width: <?php echo $model->getProgressValue();?>%"></div>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                                <?php echo $model->getBodyAsHtml();?>
                                <hr>
                            </div>
                        </div>
                        <?php if ($model->getRelated('pages',true,array('resetScope'=>true))):?>
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Related tasks</h4>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-12">
                                <table class="table table-striped">
                                    <colgroup>
                                        <col width="30px">
                                        <col>
                                        <col width="60px">
                                        <col width="60px">
                                    </colgroup>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Progress</th>
                                        <th>Assigned</th>
                                    </tr>
                                    <?php foreach ($model->pages as $page):?>
                                        <tr>
                                            <td>
                                                <div class="icheckbox_square-green<?php if ($page->status==Page::STATUS_CLOSED):?> checked<?php endif;?>"></div>
                                            </td>
                                            <td>
                                                <?php echo CHtml::link(
                                                    CHtml::encode($page->title),
                                                    array(
                                                        'project/view',
                                                        'id' => $page->project_id,
                                                        'module'=>'tickets',
                                                        'action'=>'view',
                                                        'ticket_id'=>$page->id)
                                                );?>
                                            </td>
                                            <td>
                                                <?php echo $page->getProgressPie(16)->render(array('width'=>16,'height'=>16));?>
                                            </td>
                                            <td>
                                                <?php echo $page->assignedUserPage ? $page->assignedUserPage->user->getGravatarImage(16) : '-';?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </table>
                            </div>
                        </div>
                        <?php endif;?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel blank-panel">
                                    <div class="panel-heading">
                                        <div class="panel-options">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#messages" data-toggle="tab">Messages</a>
                                                </li>
                                                <li>
                                                    <a href="#history" data-toggle="tab">History</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="messages">
                                                <?php echo $this->renderPartial('//comments/_list',array('dataProvider'=>$model->getCommentsProvider()));?>
                                            </div>
                                            <div class="tab-pane" id="history">
                                                <?php echo $this->renderPartial('//modules/project/tickets/_historyList',array('dataProvider'=>$model->getHistoryProvider()));?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

