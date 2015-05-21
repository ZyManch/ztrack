<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 12.03.2015
 * Time: 18:18
 * @var $modules AbstractProjectModule[]
 * @var $project Project
 * @var $groups Group[]
 * @var $this Controller
 */
?>

<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Groups</h2>
                        <div>
                            <?php foreach ($groups as $group):?>
                                <?php $this->renderPartial('//project/settings/_group',array('group'=>$group,'project'=>$project));?>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Installed modules</h2>
                        <?php foreach ($modules as $module):?>
                        <?php $this->renderPartial('//project/settings/_module',array('module'=>$module,'project'=>$project,'groups'=>$groups,'showInstalled'=>true));?>
                        <?php endforeach;?>
                    </div>
                    <div class="col-sm-6">
                        <h2>Not installed modules</h2>
                        <?php foreach ($modules as $module):?>
                            <?php $this->renderPartial('//project/settings/_module',array('module'=>$module,'project'=>$project,'groups'=>$groups,'showInstalled'=>false));?>
                        <?php endforeach;?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php foreach ($modules as $module):?>
    <?php $this->renderPartial('//project/settings/_moduleDialog',array('module'=>$module,'groups'=>$groups,'project'=>$project));?>
<?php endforeach;?>