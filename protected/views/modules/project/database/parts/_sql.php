<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 01.07.2015
 * Time: 9:27
 * @var ProjectDatabase $projectDatabase
 */
$flashSql = Yii::app()->user->getSQLFlash();
if (!isset($sql)) {
    $sql = $flashSql;
}

?>

<?php if ($flashSql):?>
    <div class="alert alert-success">
        <?php echo nl2br(CHtml::encode($flashSql));?>
    </div>
<?php endif;?>

<?php if ($sql || $flashSql) :?>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'sql-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('class'=>'form-horizontal')
    )); ?>
    <div class="row">
        <div class="col-xs-12">
            <?php echo CHtml::textArea(
                'sql',
                $sql ? $sql : ($flashSql ? $flashSql : ''),
                array('class'=>'form-control','rows'=>10)
            );?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-right">
            <?php echo CHtml::submitButton('Execute',array('class'=>'btn btn-primary btn-sm')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
<?php endif;?>