<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 01.07.2015
 * Time: 14:41
 * @var ProjectDatabase $projectDatabase
 * @var $count
 */
Yii::app()->clientScript->registerScript(
    'input-default-type',
    '$(".input-default-type").change(function() {
        var $this = $(this);
        $this.parent().find("input[type=text]").css("display",$this.val()=="value"?"block":"none");
    });'
);
$column = new DatabaseColumn();
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'create-column-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('class'=>'form-horizontal')
)); ?>
    Table name
    <?php echo CHtml::textField('table_name','',array('class'=>''));?>
    <table class="table table-responsive table-hover  table-bordered">
        <tr>
            <th>Column</th>
            <th>Type</th>
            <th>Size/Values</th>
            <th>Null</th>
            <th>Default</th>
            <th>AI</th>
            <th>Params</th>
        </tr>
        <?php for($i =0; $i<$count;$i++):?>
            <?php $module->renderPartial('parts._tableColumn',array(
                'name' => $i,
                'column' => $column,
                'projectDatabase'=>$projectDatabase
            ));?>
        <?php endfor;?>

        <tr>
            <td colspan="7">
                <?php echo CHtml::submitButton('Create',array('class'=>'btn btn-primary')); ?>
                <?php echo CHtml::link(
                    'Cancel',
                    array(
                        'project/view',
                        'id'=>$projectDatabase->project_id,
                        'module'=>'database',
                        'database'=>$projectDatabase->getCurrentDatabase()
                    ),
                    array('class'=>'btn btn-white')
                );?>
            </td>
        </tr>
    </table>

<?php $this->endWidget(); ?>