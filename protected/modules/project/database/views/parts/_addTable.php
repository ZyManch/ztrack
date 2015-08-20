<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 01.07.2015
 * Time: 14:41
 * @var ProjectDatabase $projectDatabase
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'create-column-form',
    'enableAjaxValidation'=>false,
    'method'=>'get',
    'action'=>array(
        'project/view',
        'id'=>$projectDatabase->project_id,
        'module'=>'database',
        'action'=>'tableCreate',
        'database'=>$projectDatabase->getCurrentDatabase()
    ),
    'htmlOptions' => array('class'=>'form-horizontal')
)); ?>
Create table with
<?php echo CHtml::numberField('count',10,array('class'=>'','style'=>'width:50px','min'=>1,'max'=>100));?>
 columns
<?php echo CHtml::submitButton('Add',array('class'=>'btn btn-primary btn-xs'));?>

<?php $this->endWidget(); ?>