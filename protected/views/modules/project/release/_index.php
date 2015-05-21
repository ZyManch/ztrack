<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 18.04.2015
 * Time: 23:01
 * @var $project Project
 * @var $this Controller
 * @var $releases ReleasePage[]
 */
Yii::app()->clientScript->registerCssFile('/css/custom.css');
?>
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content text-right">
                <?php echo CHtml::link(
                    'Create release',
                    array(
                        'project/view',
                        'id' => Yii::app()->request->getParam('id'),
                        'module'=>'release',
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

<?php foreach ($releases as $release):?>
<div class="row">
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>
                    Release <?php echo CHtml::encode($release->title);?>
                    (<?php echo $release->progress;?>%)
                </h5>
            </div>
            <div class="ibox-content">
                <?php if($release->pages):?>
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
                        <?php foreach ($release->pages as $page):?>
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
                                    <?php echo $page->getProgressPie()->render(array('width'=>16,'height'=>16));?>
                                </td>
                                <td>
                                    <?php echo $page->assignedUserPage ? $page->assignedUserPage->user->getGravatarImage(16) : '-';?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </table>
                <?php else:?>
                    Empty
                <?php endif;?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Statistic</h5>
            </div>
            <div class="ibox-content">
                <div>
                    <?php if ($release->pages):?>
                        <?php
                        $graph = Graph::model()->findByPk(GRAPH_FLOT_BAR);

                        $users = $release->_getUsers(true);
                        $graph->addData(new GraphData('Closed tasks',CHtml::listData($users,'username','count')));

                        $users = $release->_getUsers(false);
                        $graph->addData(new GraphData('Total tasks',CHtml::listData($users,'username','count')));



                        echo $graph->render(array('style'=>'width:100%;height:200px'));
                        ?>
                    <?php else:?>
                        Empty
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
