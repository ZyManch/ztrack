<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 05.04.2015
 * Time: 22:51
 * @var $system_module AbstractWidgetModule
 * @var $config Array
 * @var $form CActiveForm
 */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'config-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('class'=>'form-horizontal')
)); ?>

    <div class="form-group">
        <?php echo CHtml::label(
            'Номер тикета',
            'config-id',
            array('class'=>'col-sm-3 control-label')
        ); ?>
        <div class="col-sm-9">
            <?php echo CHtml::textField(
                'config[id]',
                isset($config['id']) ? $config['id'] : '',
                array('size'=>60,'maxlength'=>64,'class'=>'form-control','id'=>'config-id')
            ); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo CHtml::label(
            'Номер родительского тикета',
            'config-parent-id',
            array('class'=>'col-sm-3 control-label')
        ); ?>
        <div class="col-sm-9">
            <?php echo CHtml::textField(
                'config[parent_page_id]',
                isset($config['parent_page_id']) ? $config['parent_page_id'] : '',
                array('size'=>60,'maxlength'=>64,'class'=>'form-control','id'=>'config-parent-id')
            ); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo CHtml::label(
            'Номер проекта',
            'config-project-id',
            array('class'=>'col-sm-3 control-label')
        ); ?>
        <div class="col-sm-9">
            <?php echo CHtml::textField(
                'config[project_id]',
                isset($config['project_id']) ? $config['project_id'] : '',
                array('size'=>60,'maxlength'=>64,'class'=>'form-control','id'=>'config-project-id')
            ); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo CHtml::label(
            'Название тикета',
            'config-title',
            array('class'=>'col-sm-3 control-label')
        ); ?>
        <div class="col-sm-9">
            <?php echo CHtml::textField(
                'config[title]',
                isset($config['title']) ? $config['title'] : '',
                array('size'=>60,'maxlength'=>64,'class'=>'form-control','id'=>'config-title')
            ); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo CHtml::label(
            'Описание тикета',
            'config-body',
            array('class'=>'col-sm-3 control-label')
        ); ?>
        <div class="col-sm-9">
            <?php echo CHtml::textField(
                'config[body]',
                isset($config['body']) ? $config['body'] : '',
                array('size'=>60,'maxlength'=>64,'class'=>'form-control','id'=>'config-body')
            ); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo CHtml::label(
            'Прогресс',
            'config-progress',
            array('class'=>'col-sm-3 control-label')
        ); ?>
        <div class="col-sm-9">
            <?php echo CHtml::textField(
                'config[progress]',
                isset($config['progress']) ? $config['progress'] : '',
                array('size'=>60,'maxlength'=>64,'class'=>'form-control','id'=>'config-progress')
            ); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo CHtml::label(
            'Приоритет',
            'config-level-id',
            array('class'=>'col-sm-3 control-label')
        ); ?>
        <div class="col-sm-9">
            <?php echo CHtml::textField(
                'config[level_id]',
                isset($config['level_id']) ? $config['level_id'] : '',
                array('size'=>60,'maxlength'=>64,'class'=>'form-control','id'=>'config-level-id')
            ); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo CHtml::label(
            'Статус',
            'config-status',
            array('class'=>'col-sm-3 control-label')
        ); ?>
        <div class="col-sm-9">
            <?php echo CHtml::textField(
                'config[status]',
                isset($config['status']) ? $config['status'] : '',
                array('size'=>60,'maxlength'=>64,'class'=>'form-control','id'=>'config-status')
            ); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo CHtml::label(
            'Дата последнего изменения',
            'config-changed',
            array('class'=>'col-sm-3 control-label')
        ); ?>
        <div class="col-sm-9">
            <?php echo CHtml::textField(
                'config[changed]',
                isset($config['changed']) ? $config['changed'] : '',
                array('size'=>60,'maxlength'=>64,'class'=>'form-control','id'=>'config-changed')
            ); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>