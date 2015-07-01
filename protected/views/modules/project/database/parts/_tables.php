<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 30.06.2015
 * Time: 15:35
 * @var $projectDatabase ProjectDatabase
 */
?>
<table class="table">
    <tr>
        <th>Table</th>
        <th>Engine</th>
        <th>Rows</th>
        <th>Data size</th>
        <th>Index size</th>
        <th>Trash</th>
    </tr>
    <?php foreach  ($projectDatabase->getTables() as $table):?>
        <tr>
            <td>
                <?php echo CHtml::link(
                    $table['Name'],
                    array('project/view','id'=>$projectDatabase->project_id,'module' => 'database','action' => 'data','database'=>$projectDatabase->getCurrentDatabase(),'table'=>$table['Name']),
                    array()
                );?>
            </td>
            <td>
                <?php echo $table['Engine'];?>
            </td>
            <td>
                <?php if ($table['Engine'] == 'InnoDB'):?>
                    ~
                <?php endif;?>
                <?php echo Yii::app()->format->format($table['Rows'],'number');?>

            </td>
            <td>
                <?php echo Yii::app()->format->format($table['Data_length'],'size');?>
            </td>
            <td>
                <?php echo Yii::app()->format->format($table['Index_length'],'size');?>
            </td>
            <td>
                <?php echo Yii::app()->format->format($table['Data_free'],'size');?>
            </td>
        </tr>
    <?php endforeach;?>
</table>