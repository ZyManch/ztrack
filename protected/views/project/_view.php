<?php
/* @var $this ProjectController */
/* @var $data array */
?>
<li class="dd-item" data-id="<?php echo $data['id'];?>">
    <div class="dd-handle dragtable-lines">&nbsp;</div>
    <div class="note-title">
        <a href="<?php echo CHtml::normalizeUrl(array('project/view','id'=>$data['id']));?>" data-toggle="collapse" data-parent="#accordion" >
            <?php echo CHtml::encode($data['label']);?>
            <div class="ibox-tools">
                <?php echo CHtml::link(
                    '',
                    array('project/create','id'=>$data['id']),
                    array('class'=>'fa fa-plus')
                );?>
                <?php echo CHtml::link(
                    '',
                    array('project/update','id'=>$data['id']),
                    array('class'=>'fa fa-edit')
                );?>
                <?php echo CHtml::link(
                    '',
                    array('project/delete','id'=>$data['id']),
                    array('class'=>'fa fa-trash')
                );?>
            </div>
        </a>
    </div>
    <ol class="dd-list">
        <?php if ($data['items']):?>
            <?php foreach ($data['items'] as $childProject):?>
                <?php $this->renderPartial('_view',array('data'=>$childProject));?>
            <?php endforeach;?>
        <?php endif;?>
    </ol>
</li>