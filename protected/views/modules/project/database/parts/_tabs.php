<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 30.06.2015
 * Time: 15:54
 * @var $projectDatabase ProjectDatabase
 * @var $tab
 */
$tabs = array(
    'data' => 'Data',
    'structure' => 'Structure',
    'sql' => 'SQL',
    'insert' => 'Insert'
);
?>
<ul class="nav nav-tabs">
    <?php foreach ($tabs as $tabName => $title):?>
    <li class="<?php if ($tab == $tabName):?>active<?php endif;?>">
        <?php echo CHtml::link(
            $title,
            array(
                'project/view',
                'id'=>$projectDatabase->project_id,
                'module' => 'database',
                'action' => $tabName,
                'database'=>$projectDatabase->getCurrentDatabase(),
                'table'=>$projectDatabase->getCurrentTable(),
            )
        );?>
    </li>
    <?php endforeach;?>
</ul>
<div style="margin: 5px 0">
        <ul class="breadcrumb">
            <li>
                <?php echo CHtml::link(
                    CHtml::encode($projectDatabase->getCurrentDatabase()),
                    array('project/view','id'=>$projectDatabase->project_id,'module'=>'database','database'=>$projectDatabase->getCurrentDatabase())
                );?>
            </li>
            <?php if($projectDatabase->getCurrentTable()):?>
            <li>
                <?php echo CHtml::link(
                    CHtml::encode($projectDatabase->getCurrentTable()),
                    array('project/view','id'=>$projectDatabase->project_id,'module'=>'database','database'=>$projectDatabase->getCurrentDatabase(),'table'=>$projectDatabase->getCurrentTable(),'action'=>'data')
                );?>
            </li>
            <?php endif;?>
            <?php if(isset($column)):?>
                <li>
                    <?php echo CHtml::link(
                        CHtml::encode($column->name),
                        array('project/view','id'=>$projectDatabase->project_id,'module'=>'database','database'=>$projectDatabase->getCurrentDatabase(),'table'=>$projectDatabase->getCurrentTable(),'action'=>'columnUpdate','column'=>$column->name)
                    );?>
                </li>
            <?php endif;?>
        </ul>
</div>