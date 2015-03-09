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
            <div class="ibox-title">
                <div class="form-group col-xs-5 navbar-form-custom">
                    <?php echo $form->textField($model,'title',array('placeholder'=>'Введите заголовок','class'=>'form-control'));?>
                </div>
                <div class="ibox-tools">
                    <input type="submit" value="Submit" class="btn btn-primary btn-xs">
                    <?php echo CHtml::link(
                        'Cancel',
                        array(
                            'project/view',
                            'id'=>Yii::app()->request->getParam('id'),
                            'module'=>'wiki',
                            'action' => 'view'
                        ),
                        array('class'=>'btn btn-white btn-xs')
                    );?>
                </div>
            </div>
            <div class="ibox-content">

                <?php echo Yii::app()->user->getEditor()->getHtmlEditor($model,'body');?>


            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>