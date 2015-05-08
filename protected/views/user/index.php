<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

Yii::app()->clientScript->registerScript(
    'contact-box',
    '$(document).ready(function(){
            $(".contact-box").each(function() {
                animationHover(this, "pulse");
            });
        });'

);
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2>Users</h2>
        </div>

        <div class="ibox-tools">
            <?php if (Yii::app()->user->checkAccess(PERMISSION_USER_MANAGE)):?>
                <?php echo CHtml::link(
                    'Invite new user',
                    array('user/create'),
                    array('class'=>'btn btn-primary')
                );?>
            <?php endif;?>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">

        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
        )); ?>

    </div>
</div>
