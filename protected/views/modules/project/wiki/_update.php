<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 17:43
 * @var $this Controller
 * @var $model Page
 * @var $form CActiveForm
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
                        <?php echo $form->textField($model,'title',array('placeholder'=>'Title','class'=>'form-control'));?>
                    </div>
                    <div class="col-xs-6 text-right">
                        <input type="submit" value="Submit" class="btn btn-primary btn-xs">
                        <?php echo CHtml::link(
                            'Cancel',
                            array(
                                'project/view',
                                'id'=>Yii::app()->request->getParam('id'),
                                'module'=>'wiki',
                                'action' => 'view',
                                'wiki' => Yii::app()->request->getParam('wiki','')
                            ),
                            array('class'=>'btn btn-white btn-xs')
                        );?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?php echo Yii::app()->user->getEditor()->getHtmlEditor($model,'body');?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>