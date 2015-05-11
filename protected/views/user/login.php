<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
    <div class="row">
        <div class="col-xs-4">
            <div class="page-header">
                <h1>Log in</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                    'htmlOptions' => array('class'=>'form-horizontal')
                ),
            )); ?>

                <div class="form-group">
                    <label class="col-sm-4 control-label">EMail:</label>
                    <div class="col-sm-8">
                        <?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Password:</label>
                    <div class="col-sm-8">
                        <?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="checkbox">
                            <label>
                                <?php echo $form->checkBox($model,'rememberMe'); ?>
                                Save me
                            </label>
                        </div>
                    </div>
                </div>



                <div class="form-actions col-sm-offset-4 col-sm-8">
                    <input type="submit" value="Login" class="btn btn-primary"/>
                </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>