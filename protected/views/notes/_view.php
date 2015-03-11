<?php
/* @var $this NotesController */
/* @var $data Page */
/* @var $with_body bool */
?>
<li>
    <a href="#note<?php echo $data->id;?>" data-toggle="collapse" data-parent="#accordion" >
        <?php echo CHtml::encode($data->title);?>
    </a>
    <div class="collapse" id="note<?php echo $data->id;?>">
        <hr>
        <?php echo $data->getBodyAsHtml();?>
    </div>
</li>
<li class="level">
<?php if ($data->childPages):?>
    <ul class="todo-list m-t ui-sortable">
        <?php foreach ($data->childPages as $childPage):?>
            <?php $this->renderPartial('_view',array('data'=>$childPage));?>
        <?php endforeach;?>
    </ul>
<?php endif;?>
</li>