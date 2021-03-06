<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 30.06.2015
 * Time: 16:09
 * @var $project Project
 * @var $tab
 * @var $rows
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
                            array('projectDatabase'=>$projectDatabase,'tab'=>'sql')
                        );?>
                        <?php $module->renderPartial(
                            'parts._sql',
                            array('projectDatabase'=>$projectDatabase,'sql'=>$sql)
                        );?>
                        <?php if (is_array($rows) && $rows):?>
                            <?php $module->renderPartial(
                                'parts._data',
                                array('projectDatabase'=>$projectDatabase,'rows'=>$rows)
                            );?>
                        <?php endif;?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>