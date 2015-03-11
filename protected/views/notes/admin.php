<?php
/* @var $this NotesController */
/* @var $model Page */
$clientScript = Yii::app()->clientScript;
$clientScript->registerScript('nest',
    '$("#nestable").nestable({
         group: 1
     }).on("change", function() {

     });',
    CClientScript::POS_READY)
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2>My notes</h2>
        </div>
        <div class="text-right">
            <?php echo CHtml::link('Cancel',array('notes/index'),array('class'=>'btn btn-primary'));?>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="col-xs-12">
        <div class="ibox ">
            <div class="ibox-content">

                <div class="dd" id="nestable">
                    <ol class="dd-list">
                        <?php foreach ($notes as $note):?>
                            <?php $this->renderPartial('_sort', array('data'=>$note,'with_body'=>false));?>
                        <?php endforeach;?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
