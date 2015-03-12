<?php
/* @var $this NotesController */
/* @var $data Page */
?>
<li class="dd-item" data-id="1">
    <div class="dd-handle">
        <?php echo CHtml::encode($data->title);?>
        
    </div>
    <?php if ($data->pages):?>
        <ol class="dd-list">
            <?php foreach ($data->pages as $childPage):?>
                <?php $this->renderPartial('_view',array('data'=>$childPage));?>
            <?php endforeach;?>
        </ol>
    <?php endif;?>
</li>