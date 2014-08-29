<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form TbActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="block non-border-left non-border-right">
    <h1>Вход на сайт</h1>

    <div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'login-form',
        'type'=>'horizontal',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

        <?php echo $form->textFieldRow($model,'email'); ?>

        <?php echo $form->passwordFieldRow($model,'password',array()); ?>

        <?php echo $form->checkBoxRow($model,'rememberMe'); ?>

        <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>'Login',
            )); ?>
        </div>

    <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>