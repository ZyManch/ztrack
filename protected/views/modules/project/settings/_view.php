<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 12.03.2015
 * Time: 18:18
 * @var $settings SystemModule[]
 * @var $project Project
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'project-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array()
)); ?>
<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="form-group col-xs-6">
                    </div>
                    <div class="col-xs-6 text-right">
                        <input type="submit" value="Save" class="btn btn-primary btn-xs">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?php echo CHtml::hiddenField('modules');?>
                        <?php foreach ($settings as $setting):?>
                        <div class="checkbox">
                            <label>
                                <?php echo CHtml::checkBox(
                                    'modules['.$setting->id.']',
                                    $project->haveSystemModule($setting)
                                );?>
                                <?php echo CHtml::encode($setting->title);?>
                            </label>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>