<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 12.03.2015
 * Time: 14:38
 * @var $note Page
 */
?>
<li class="dd-item">
    <div class="dd-item ">
        <div class="dd-handle">
            <?php echo CHtml::link(
                '<span class="fa fa-plus"></span>',
                array('notes/create','id'=>$note->id)
            );?>
        </div>
    </div>
</li>