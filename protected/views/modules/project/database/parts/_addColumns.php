<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 01.07.2015
 * Time: 14:41
 * @var ProjectDatabase $projectDatabase
 * @var DatabaseColumn[] $columns
 * @var DatabaseColumn $lastColumn
 */
$columns = array();
foreach ($projectDatabase->getCurrentColumns() as $column) {
    $columns[$column->name] = $column->name;
}
$lastColumn = end($columns);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'create-column-form',
    'enableAjaxValidation'=>false,
    'method'=>'get',
    'action'=>array(
        'project/view',
        'id'=>$projectDatabase->project_id,
        'module'=>'database',
        'action'=>'columnCreate',
        'database'=>$projectDatabase->getCurrentDatabase(),
        'table'=>$projectDatabase->getCurrentTable()
    ),
    'htmlOptions' => array('class'=>'form-horizontal')
)); ?>
Add
<?php echo CHtml::numberField('count',1,array('class'=>'','style'=>'width:50px','min'=>1,'max'=>100));?>
 columns
<label>
    <?php echo CHtml::radioButton('position',false,array('value' => 'start'));?> at start of table
</label>
    or
<label>
    <?php echo CHtml::radioButton('position',true,array('value' => 'after'));?> after
</label>
<?php echo CHtml::dropDownList('after_column',$lastColumn,$columns);?> column
<?php echo CHtml::submitButton('Add',array('class'=>'btn btn-primary btn-xs'));?>

<?php $this->endWidget(); ?>