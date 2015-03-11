<?php
/* @var $this NotesController */
/* @var $notes Page[] */
/* @var $clientScript CClientScript */
$clientScript = Yii::app()->clientScript;

?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2>My notes</h2>
        </div>
        <div class="text-right">
            <?php echo CHtml::link('Sort',array('notes/admin'),array('class'=>'btn btn-primary'));?>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="col-xs-12">
        <div class="ibox ">
            <div class="ibox-content">

                <ul class="todo-list m-t ui-sortable">
                    <?php foreach ($notes as $note):?>
                        <?php $this->renderPartial('_view', array('data'=>$note,'with_body'=>true));?>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
</div>
