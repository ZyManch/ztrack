<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 01.07.2015
 * Time: 8:28
 * @var $projectDatabase ProjectDatabase
 * @var $values
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'row-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('class'=>'form-horizontal')
)); ?>
<table class="table table-hover  table-bordered table-responsive">
    <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Is null</th>
        <th>Value</th>
    </tr>
    <?php foreach ($projectDatabase->getCurrentColumns() as $column):?>
        <?php $value = (isset($values[$column->name]) ? $values[$column->name] : '') ;?>
        <tr>
            <td><?php echo CHtml::encode($column->name);?></td>
            <td><?php echo CHtml::encode($column->type);?></td>
            <td>
                <?php if ($column->null):?>
                    <?php echo CHtml::checkBox(
                        'nulls['.$column->name.']',
                        !isset($values[$column->name]) || is_null($value)
                    );?>
                <?php endif;?>
            </td>
            <?php if (in_array($column->type,array('tinyint','smallint','mediumint','int','bigint'))):?>
                <td><?php echo CHtml::numberField('values['.$column->name.']',$value,array('class'=>'form-control'));?></td>
            <?php elseif (in_array($column->type,array('text','varchar'))): ?>
                <td><?php echo CHtml::textArea('values['.$column->name.']',$value,array('class'=>'form-control'));?></td>
            <?php elseif (in_array($column->type,array('enum'))): ?>
                <td><?php echo CHtml::dropDownList('values['.$column->name.']',$value,$column->getSizeVariant(),array('class'=>'form-control'));?></td>
            <?php elseif (in_array($column->type,array('set'))): ?>
                <td><?php echo CHtml::checkBoxList('values['.$column->name.']',$value,$column->getSizeVariant(),array('class'=>'form-control'));?></td>
            <?php else:?>
                <td><?php echo CHtml::textField('values['.$column->name.']',$value,array('class'=>'form-control'));?></td>
            <?php endif;?>
        </tr>
    <?php endforeach;?>
    <tr>
        <td colspan="4">
            <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-primary')); ?>
            <?php echo CHtml::link(
                'Cancel',
                array(
                    'project/view',
                    'id'=>$projectDatabase->project_id,
                    'module'=>'database',
                    'action'=>'data',
                    'database'=>$projectDatabase->getCurrentDatabase(),
                    'table'=>$projectDatabase->getCurrentTable()
                ),
                array('class'=>'btn btn-white')
            );?>
        </td>
    </tr>
</table>

<?php $this->endWidget(); ?>