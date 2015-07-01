<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 30.06.2015
 * Time: 10:28
 * @var $project Project
 * @var $tab
 * @var $projectDatabase ProjectDatabase
 * @var $row
 */
$databases = $projectDatabase->getDatabases();
?>
<div class="row">
    <div class="col-md-12">
        <div class="ibox">
            <div class="ibox-content">
                <div class="text-right">
                    <?php $this->renderPartial(
                        '//modules/project/database/parts/_databaseLinks',
                        array('databases'=>$databases,'projectDatabase'=>$projectDatabase)
                    );?>
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <?php $this->renderPartial(
                            '//modules/project/database/parts/_tableLinks',
                            array('projectDatabase'=>$projectDatabase)
                        );?>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <?php $this->renderPartial(
                            '//modules/project/database/parts/_tabs',
                            array('projectDatabase'=>$projectDatabase,'tab'=>'data')
                        );?>
                        <?php $this->renderPartial(
                            '//modules/project/database/parts/_form',
                            array('projectDatabase'=>$projectDatabase,'values'=>$row)
                        );?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>