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
                    <div class="col-xs-12">
                        <?php $module->renderPartial(
                            'parts._tables',
                            array('projectDatabase'=>$projectDatabase)
                        );?>
                        <?php $module->renderPartial(
                            'parts._addTable',
                            array('projectDatabase'=>$projectDatabase)
                        );?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>