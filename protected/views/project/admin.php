<?php
/* @var $this ProjectController */
/* @var $projects array */
$clientScript = Yii::app()->clientScript;
$clientScript->registerScript('nest',
    sprintf('
        $("#nestable").nestable({
             group: 1,
             expandBtnHTML: "",
             collapseBtnHTML: ""
        }).on("change", function() {
            $.post("%s",{"projects":$(this).nestable("serialize")});
        });',
        CHtml::normalizeUrl(array('project/sort'))
    ),
    CClientScript::POS_READY);
?>

<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>Projects</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">

        <ul class="dd" id="nestable">
            <ol class="dd-list">
                <?php if ($projects):?>
                    <?php foreach ($projects as $project):?>
                        <?php $this->renderPartial('_view', array('data'=>$project));?>
                    <?php endforeach;?>
                <?php endif;?>
            </ol>
        </ul>
    </div>
</div>