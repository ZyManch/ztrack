<?php
/* @var $this NotesController */
/* @var $data Page */
/* @var $with_body bool */
?>
<li class="dd-item" data-id="<?php echo $data->id;?>">
    <div class="dd-handle dragtable-lines">&nbsp;</div>
    <div class="note-title">
        <a href="#note<?php echo $data->id;?>" data-toggle="collapse" data-parent="#accordion" >
            <?php echo CHtml::encode($data->title);?>
            <?php foreach($data->labels as $label):?>
            <span class="badge" style="background-color: #<?php echo $label->color;?>;color:#<?php echo $label->getTextColor();?>">
                <?php echo CHtml::encode($label->title);?>
            </span>
            <?php endforeach;?>
            <div class="ibox-tools">
                <?php echo CHtml::link(
                    '',
                    array('notes/create','id'=>$data->id),
                    array('class'=>'fa fa-plus')
                );?>
                <?php echo CHtml::link(
                    '',
                    array('notes/update','id'=>$data->id),
                    array('class'=>'fa fa-edit')
                );?>
                <?php echo CHtml::link(
                    '',
                    array('notes/delete','id'=>$data->id),
                    array('class'=>'fa fa-trash')
                );?>
            </div>
        </a>
        <div class="collapse" id="note<?php echo $data->id;?>">
            <hr>
            <?php echo $data->getBodyAsHtml();?>
        </div>
    </div>
    <ol class="dd-list">
        <?php if ($data->pages):?>
            <?php foreach ($data->pages as $childPage):?>
                <?php $this->renderPartial('_view',array('data'=>$childPage));?>
            <?php endforeach;?>
        <?php endif;?>
    </ol>
</li>
