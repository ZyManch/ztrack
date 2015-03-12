<?php
/* @var $this NotesController */
/* @var $model Page */
/* @var $id int */
/* @var $notes Page[] */
$clientScript = Yii::app()->clientScript;
$clientScript->registerScript('nest',
    '$("#nestable").nestable({
         group: 1
     }).on("change", function() {

     });',
    CClientScript::POS_READY);
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
                array('notes/admin','id'=>$note->id),
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
            <?php echo CHtml::link('Cancel',array('notes/index','id'=>$id),array('class'=>'btn btn-white'));?>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="col-xs-12">
        <div class="ibox ">
            <div class="ibox-content">

                <div class="dd" id="nestable">
                    <ol class="dd-list">
                        <?php if ($mainNote):?>
                            <?php foreach ($mainNote->pages as $subNote):?>
                                <?php $this->renderPartial('_sort', array('data'=>$subNote));?>
                            <?php endforeach;?>
                        <?php endif;?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
