<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 05.04.2015
 * Time: 22:46
 * @var SystemModule[] $modules
 * @var Dashboard $dashboard
 * @var DashboardController $this
 */
?>
<div class="wrapper wrapper-content ">
    <div class="col-xs-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add widget to <?php echo CHtml::encode($dashboard->name);?></h5>
            </div>
            <div class="ibox-content">
                <p>
                    Choice module type to continue
                </p>
                <div class="hr-line-dashed"></div>
                <div class="row">
                    <?php foreach ($modules as $module):?>
                        <?php if ($module->checkAccess()):?>
                            <div class="col-xs-4">
                                <a href="<?php echo CHtml::normalizeUrl(array(
                                    'dashboard/createWidget2',
                                    'id' => $dashboard->id,
                                    'system_module_id' => $module->id
                                ));?>" class="btn btn-white btn-block">
                                    <strong><?php echo $module->title;?></strong>
                                    <br>
                                    <?php echo $module->description;?>
                                </a>
                            </div>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>
                <div class="hr-line-dashed clear"></div>
                <div class="text-right">
                        <?php echo CHtml::link(
                            'Cancel',
                            array('dashboard/index','id'=>$dashboard->id),
                            array('class'=>'btn btn-white')
                        );?>
                </div>
            </div>
        </div>
    </div>
</div>