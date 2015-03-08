<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form TbActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h1>Обратная связь</h1>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-xs-12">

        <?php if(Yii::app()->user->hasFlash('contact')): ?>
            <div class="alert alert-danger">
                <?php echo Yii::app()->user->getFlash('contact');?>
            </div>

        <?php else: ?>

        <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
        </p>

        <div class="form">

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'contact-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
                'htmlOptions' => array('class'=>'form-horizontal')
            ),
        )); ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldRow($model,'name'); ?>

            <?php echo $form->textFieldRow($model,'email'); ?>

            <?php echo $form->textFieldRow($model,'subject',array('size'=>60,'maxlength'=>128)); ?>

            <?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'class'=>'span8')); ?>

            <?php if(CCaptcha::checkRequirements()): ?>
                <?php echo $form->captchaRow($model,'verifyCode',array(
                    'hint'=>'Please enter the letters as they are shown in the image above.<br/>Letters are not case-sensitive.',
                )); ?>
            <?php endif; ?>

            <div class="form-actions">
                <?php $this->widget('bootstrap.widgets.TbButton',array(
                    'buttonType'=>'submit',
                    'type'=>'primary',
                    'label'=>'Submit',
                )); ?>
            </div>

        <?php $this->endWidget(); ?>

    </div>
</div><!-- form -->

<?php endif; ?>