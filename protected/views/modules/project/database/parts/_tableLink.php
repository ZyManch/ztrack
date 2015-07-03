<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 30.06.2015
 * Time: 15:22
 * @var array $table
 * @var ProjectDatabase $projectDatabase
 * @var bool $isSub
 */
if ($isSub) {
    $title = explode('_',$table['Name'],2);
    $title = $title[1];
    if (!$title) {
        $title = '<main>';
    }
} else {
    $title = $table['Name'];
}
?>

<?php echo CHtml::link(
    CHtml::encode($title),
    array(
        'project/view',
        'id'=>$projectDatabase->project_id,
        'module'=>'database',
        'action'=>'data',
        'database'=>$projectDatabase->getCurrentDatabase(),
        'table'=>$table['Name']
    ),
    array(

    )
);?>