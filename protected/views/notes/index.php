<?php
/* @var $this NotesController */
/* @var $notes Page[] */


?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2>My notes</h2>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="col-xs-12">
        <div class="ibox ">
            <div class="ibox-content">

                <div class="dd" id="nestable">
                    <ol class="dd-list panel-group" id="accordion">
                        <?php foreach ($notes as $note):?>
                            <?php $this->renderPartial('_view', array('data'=>$note));?>
                        <?php endforeach;?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
