<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 01.07.2015
 * Time: 14:41
 * @var ProjectDatabase $projectDatabase
 * @var DatabaseColumn $column
 */
?>
<table class="table table-responsive table-hover  table-bordered">
    <tr>
        <th>&nbsp;</th>
        <th>Column</th>
        <th>Type</th>
        <th>Null</th>
        <th>Default</th>
        <th>Params</th>
    </tr>
    <?php foreach ($projectDatabase->getCurrentColumns() as $column):?>
    <tr>
        <td>
            <?php echo CHtml::link(
                '<span class="fa fa-edit"></span>',
                array(
                    'project/view',
                    'id'=>$projectDatabase->project_id,
                    'module'=>'database',
                    'action'=>'columnUpdate',
                    'database'=>$projectDatabase->getCurrentDatabase(),
                    'table'=>$projectDatabase->getCurrentTable(),
                    'column'=>$column->name
                )
            );?><?php echo CHtml::link(
                '<span class="fa fa-trash-o"></span>',
                array(
                    'project/view',
                    'id'=>$projectDatabase->project_id,
                    'module'=>'database',
                    'action'=>'columnDelete',
                    'database'=>$projectDatabase->getCurrentDatabase(),
                    'table'=>$projectDatabase->getCurrentTable(),
                    'column'=>$column->name
                )
            );?>
        </td>
        <td>
            <?php echo CHtml::encode($column->name);?>
        </td>
        <td>
            <?php echo CHtml::encode($column->type);?>
            (<?php echo $column->size;?>)
        </td>
        <td>
            <?php echo $column->null?'yes':'no';?>
        </td>
        <td>
            <?php echo CHtml::encode(is_null($column->default) && $column->null ? 'null' : $column->default);?>
        </td>
        <td>
            <?php echo CHtml::encode(implode(',',$column->params));?>
        </td>
    </tr>
    <?php endforeach;?>
</table>