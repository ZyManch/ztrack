<?php
/* @var $this NotesController */
/* @var $notes Page[] */
/* @var $clientScript CClientScript */
$clientScript = Yii::app()->clientScript;
$mainNote = null;
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2>My notes</h2>
        </div>
        <?php foreach ($notes as $note):?>
            <?php if($note->id==$id):?>
                <?php $mainNote = $note;?>
            <?php endif;?>
            <?php echo CHtml::link(
                $note->title,
                array('notes/index','id'=>$note->id),
                array('class'=>'btn btn-success'.($note->id == $id ? ' active':''))
            );?>
        <?php endforeach;?>
        <?php echo CHtml::link(
            '+',
            array('notes/create'),
            array('class'=>'btn btn-success')
        );?>
        <div class="ibox-tools">
            <?php echo CHtml::link('Add',array('notes/create','id'=>$id),array('class'=>'btn btn-primary'));?>
            <?php echo CHtml::link('Sort',array('notes/admin','id'=>$id),array('class'=>'btn btn-white'));?>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="col-xs-12">
        <div class="ibox ">
            <div class="ibox-content">

                <ul class="todo-list m-t ui-sortable">
                    <?php if ($mainNote):?>
                        <?php foreach ($mainNote->pages as $note):?>
                            <?php $this->renderPartial('_view', array('data'=>$note));?>
                        <?php endforeach;?>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </div>
</div>
