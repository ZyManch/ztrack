<?php
/* @var $this NotesController */
/* @var $data Page */
?>
<li class="dd-item" data-id="1">
    <div class="ibox ">
        <div class="ibox-title">
            <h5 class="">
                <a data-toggle="collapse" data-parent="#accordion" href="#note<?php echo $data->id;?>">
                    <?php echo CHtml::encode($data->title);?>
                </a>
            </h5>
        </div>
        <div class="ibox-content collapse" id="note<?php echo $data->id;?>">
            <div class="panel-body">
                <?php echo $data->getBodyAsHtml();?>
            </div>
        </div>

    </div>
    <?php if ($data->childPages):?>
        <ol class="dd-list">
            <?php foreach ($data->childPages as $childPage):?>
                <?php $this->renderPartial('_view',array('data'=>$childPage));?>
            <?php endforeach;?>
        </ol>
    <?php endif;?>
</li>