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
                    <div class="col-lg-12">
                        <h1>[#<?php echo $model->id;?>] <?php echo CHtml::encode($model->getTitle());?></h1>
                        <?php if ($model->parent_page_id):?>
                            <?php echo implode(' > ', $model->getParentsList(true));?>
                        <?php endif;?>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-lg-2 text-center">
                        <div class="list-group">
                            <?php if ($model->assignUser):?>
                                <a class="list-group-item active" href="#">
                                    <h4 class="list-group-item-heading">
                                        Назначено
                                        <?php echo $model->assignUser->username;?>
                                    </h4>
                                    <p class="list-group-item-text">
                                        <?php echo $model->assignUser->getGravatarImage(64);?>
                                    </p>
                                </a>
                            <?php endif;?>
                            <a class="list-group-item<?php if (!$model->assignUser):?> active<?php endif;?>" href="#">
                                <h4 class="list-group-item-heading">
                                    Назначить
                                </h4>
                                <p class="list-group-item-text">
                                    -
                                </p>
                            </a>
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
                                            <div class="progress-bar" style="width: <?php echo $model->progress;?>%"></div>
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
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel blank-panel">
                                    <div class="panel-heading">
                                        <div class="panel-options">
                                            <div class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#messages" data-toggle="tab">Messages</a>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="messages">
                                                <?php echo $this->renderPartial('//comments/_list',array('dataProvider'=>$model->getCommentsProvider()));?>
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

