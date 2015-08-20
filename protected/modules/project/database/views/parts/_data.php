<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 01.07.2015
 * Time: 14:37
 * @var $rows
 * @var $projectDatabase ProjectDatabase
 */
$headers = array_keys($rows[0]);
?>
<table class="table table-responsive table-hover  table-bordered">
    <tr>
        <?php foreach($headers as $header):?>
            <th><?php echo CHtml::encode($header);?></th>
        <?php endforeach;?>
    </tr>
    <?php foreach ($rows as $row):?>
        <tr>
            <?php foreach($row as $value):?>
            <td><?php echo CHtml::encode($value);?></td>
            <?php endforeach;?>
        </tr>
    <?php endforeach;?>
</table>