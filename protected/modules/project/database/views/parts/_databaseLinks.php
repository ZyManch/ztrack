<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 30.06.2015
 * Time: 15:30
 * @var $projectDatabase ProjectDatabase
 * @var $databases array
 */
?>
<?php foreach ($databases as $database):?>
    <?php echo CHtml::link(
        CHtml::encode($database),
        array('project/view','id'=>$projectDatabase->project_id,'module'=>'database','database'=>$database),
        array('class'=>'btn btn-primary'.($database==$projectDatabase->getCurrentDatabase() ? ' active':''))
    );?>

<?php endforeach;?>