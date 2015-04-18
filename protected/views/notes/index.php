<?php
/* @var $this NotesController */
/* @var $notes Page[] */
/* @var $clientScript CClientScript */
/* @var $id int */
$clientScript = Yii::app()->clientScript;
$mainNote = $notes[$id];
$clientScript = Yii::app()->clientScript;
$clientScript->registerScript('nest',
    sprintf('
        $("#nestable").nestable({
             group: 1,
             expandBtnHTML: "",
             collapseBtnHTML: ""
        }).on("change", function() {
            $.post("%s",{"notes":$(this).nestable("serialize")});
        });',
        CHtml::normalizeUrl(array('notes/sort','id'=>$mainNote->id))
    ),
    CClientScript::POS_READY);
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2>My notes</h2>
        </div>
        <?php foreach ($notes as $note):?>
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
        </div>
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="col-xs-12">
        <div class="ibox ">
            <div class="ibox-content">

                <ul class="dd" id="nestable">
                    <ol class="dd-list">
                        <?php if ($mainNote):?>
                            <?php foreach ($mainNote->pages as $note):?>
                                <?php $this->renderPartial('_view', array('data'=>$note));?>
                            <?php endforeach;?>
                        <?php endif;?>
                    </ol>
                </ul>
            </div>
        </div>
    </div>
</div>
