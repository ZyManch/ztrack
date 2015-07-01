<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 01.07.2015
 * Time: 14:41
 * @var ProjectDatabase $projectDatabase
 * @var $columns
 */
Yii::app()->clientScript->registerScript(
    'input-default-type',
    '$(".input-default-type").change(function() {
        var $this = $(this);
        $this.parent().find("input[type=text]").css("display",$this.val()=="value"?"block":"none");
    });'
);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'row-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('class'=>'form-horizontal')
)); ?>
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
    <?php foreach ($columns as $column):?>
    <tr>
        <td>
            <?php echo CHtml::textField('column['.$column['name'].'][name]',$column['name'],array('class'=>'form-control'));?>
        </td>
        <td>
            <?php echo CHtml::dropDownList(
                'column['.$column['type'].'][type]',
                $column['type'],
                array(
                    'int' => 'Int',
                    'varchar' => 'Varchar',
                    'text' => 'Text',
                    'date' => 'Date',
                    'Numbers' => array(
                        'tinyint' => 'TinyInt',
                        'smallint' => 'SmallInt',
                        'mediumint' => 'MediumInt',
                        'int' => 'Int',
                        'bigint' => 'BigInt'
                    ),
                    'Floats' => array(
                        'decimal' => 'Decimal',
                        'float' => 'Float',
                        'double' => 'Double',
                        'real' => 'Real',
                        'bit' => 'Bit',
                        'boolean' => 'Boolean',
                        'serial' => 'Serial',
                    ),
                    'Date' => array(
                        'date' => 'Date',
                        'datetime'=>'DateTime',
                        'timestamp' => 'Timestamp',
                        'time' => 'Time',
                        'year' => 'Year',
                    ),
                    'Text' => array(
                        'char' => 'Char',
                        'varchar' => 'VarChar',
                        'tinytext' => 'TinyText',
                        'text' => 'Text',
                        'mediumtext'=>'MediumText',
                        'longtext'=>'LongText',
                        'binary'=>'Binary',
                        'varbinary'=>'Varbinary',
                        'tinyblob' => 'TinyBlob',
                        'mediumblob' => 'MediumBlob',
                        'blob' => 'Blob',
                        'longblob' => 'LongBlob',
                        'enum' => 'Enum',
                        'set' => 'Set',
                    ),
                    'Geometry' => array(
                        'geometry' => 'Geometry',
                        'point' => 'Point',
                        'linestring' => 'LineString',
                        'polygon' => 'Polygon',
                        'multypoint' => 'MultyPoint',
                        'multylinestring' => 'MultyLineString',
                        'multypolygon' => 'MultyPolygon',
                        'geometrycollection' => 'GeometryCollection'
                    )
                ),
                array('class'=>'form-control')
            );?>
        </td>
        <td>
            <?php echo CHtml::textField(
                'column['.$column['type'].'][size]',
                is_array($column['size']) ? "'".implode("','",$column['size'])."'" : $column['size'],
                array('class'=>'form-control')
            );?>
        </td>
        <td>
            <?php echo CHtml::checkBox(
                'column['.$column['type'].'][null]',
                $column['null']
            );?>
        </td>
        <td>
            <?php $defaultType = is_null($column['default']) ?
                ($column['null'] ? 'null': 'no') :
                ($column['default'] == 'CURRENT_TIMESTAMP' ? 'timestamp' : 'value');?>
            <?php echo CHtml::dropDownList(
                'column['.$column['type'].'][default_type]',
                $defaultType,
                array('no' => 'No','value'=>'As defined','null'=>'NULL','timestamp'=>'CURRENT_TIMESTAMP'),
                array('class'=>'form-control input-default-type')
            );?>
            <?php echo CHtml::textField(
                    'column['.$column['type'].'][default]',
                    $defaultType == 'value' ? $column['default'] : '',
                    array('class'=>'form-control','style'=>$defaultType == 'value'?'':'display:none')
            );?>
        </td>
        <td>
            <?php echo CHtml::checkBox(
                'column['.$column['type'].'][ai]',
                in_array('auto_increment',$column['params'])
            );?>
        </td>
        <td>
            <?php echo CHtml::dropDownList(
                'column['.$column['type'].'][attr]',
                in_array('unsigned zerofill',$column['params']) ? 'zerofill' :
                    (in_array('unsigned',$column['params']) ? 'unsigned' :
                        (in_array('on update CURRENT_TIMESTAMP',$column['params']) ? 'timestamp' :
                            (in_array('binary',$column['params']) ? 'binary' : ''))),
                array('binary'=>'Binary','unsigned'=>'Unsigned','zerofill'=>'Unsigned Zerofill','timestamp'=>'on update CURRENT_TIMESTAMP'),
                array('empty'=>'','class'=>'form-control')
            );?>
        </td>
    </tr>
    <?php endforeach;?>

    <tr>
        <td colspan="7">
            <?php echo CHtml::submitButton('Save',array('class'=>'btn btn-primary')); ?>
            <?php echo CHtml::link(
                'Cancel',
                array(
                    'project/view',
                    'id'=>$projectDatabase->project_id,
                    'module'=>'database',
                    'action'=>'structure',
                    'database'=>$projectDatabase->getCurrentDatabase(),
                    'table'=>$projectDatabase->getCurrentTable()
                ),
                array('class'=>'btn btn-white')
            );?>
        </td>
    </tr>
    </table>

<?php $this->endWidget(); ?>