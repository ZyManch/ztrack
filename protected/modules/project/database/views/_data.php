<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 30.06.2015
 * Time: 10:28
 * @var $project Project
 * @var $tab
 * @var $projectDatabase ProjectDatabase
 */
$databases = $projectDatabase->getDatabases();
?>
<div class="row">
    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-content">
                <div class="text-right">
                    <?php $module->renderPartial(
                        'parts._databaseLinks',
                        array('databases'=>$databases,'projectDatabase'=>$projectDatabase)
                    );?>
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <?php $module->renderPartial(
                            'parts._tableLinks',
                            array('projectDatabase'=>$projectDatabase)
                        );?>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <?php $module->renderPartial(
                            'parts._tabs',
                            array('projectDatabase'=>$projectDatabase,'tab'=>'data')
                        );?>
                        <?php $module->renderPartial(
                            'parts._sql',
                            array('projectDatabase'=>$projectDatabase)
                        );?>
                        <?php $this->widget('zii.widgets.grid.CGridView', array(
                            'id'=>'message-grid',
                            'filter' => true,
                            'dataProvider'=>$projectDatabase->getTableDataProvider(),
                            'template'=>'{items} {summary} {pager}',
                            'itemsCssClass' => 'table table-hover  table-bordered',
                            'columns'=>$projectDatabase->getTableColumns()
                        )); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>