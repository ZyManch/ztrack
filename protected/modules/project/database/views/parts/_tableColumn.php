<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 01.07.2015
 * Time: 14:41
 * @var ProjectDatabase $projectDatabase
 * @var $column DatabaseColumn
 * @var $name
 */
Yii::app()->clientScript->registerScript(
    'input-default-type',
    '$(".input-default-type").change(function() {
        var $this = $(this);
        $this.parent().find("input[type=text]").css("display",$this.val()=="value"?"block":"none");
    });'
);
?>
<tr>
    <td>
        <?php echo CHtml::textField('columns['.$name.'][name]',$column->name,array('class'=>'form-control'));?>
    </td>
    <td>
        <?php echo CHtml::dropDownList(
            'columns['.$name.'][type]',
            $column->type,
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
            'columns['.$name.'][size]',
            $column->size,
            array('class'=>'form-control')
        );?>
    </td>
    <td>
        <?php echo CHtml::checkBox(
            'columns['.$name.'][null]',
            $column->null
        );?>
    </td>
    <td>
        <?php echo CHtml::dropDownList(
            'columns['.$name.'][default_type]',
            $column->default_type,
            array(
                DatabaseColumn::DEFAULT_TYPE_NO        => 'No',
                DatabaseColumn::DEFAULT_TYPE_VALUE     => 'As defined',
                DatabaseColumn::DEFAULT_TYPE_NULL      => 'NULL',
                DatabaseColumn::DEFAULT_TYPE_TIMESTAMP => 'CURRENT_TIMESTAMP'
            ),
            array('class'=>'form-control input-default-type')
        );?>
        <?php echo CHtml::textField(
            'columns['.$name.'][default]',
            $column->default_type == DatabaseColumn::DEFAULT_TYPE_VALUE ? $column->default : '',
            array(
                'class'=>'form-control',
                'style'=>$column->default_type == DatabaseColumn::DEFAULT_TYPE_VALUE?'':'display:none'
            )
        );?>
    </td>
    <td>
        <?php echo CHtml::checkBox(
            'columns['.$name.'][ai]',
            $column->ai
        );?>
    </td>
    <td>
        <?php echo CHtml::dropDownList(
            'columns['.$name.'][attr]',
            $column->attr,
            array('binary'=>'Binary','unsigned'=>'Unsigned','zerofill'=>'Unsigned Zerofill','timestamp'=>'on update CURRENT_TIMESTAMP'),
            array('empty'=>'','class'=>'form-control')
        );?>
    </td>
</tr>


