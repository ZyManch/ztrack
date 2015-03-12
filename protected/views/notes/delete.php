<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 12.03.2015
 * Time: 14:53
 * @var $model Page
 * @var $parentId int
 */
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-xs-12">
        <div class="page-header">
            <h2>Delete "<?php echo $model->title;?>"</h2>
        </div>
        <div class="row">
            <div class="col-xs-12">
                You are sure delete this note?
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <form method="post">
                    <input type="submit" class="btn btn-primary btn-lg" value="Confirm">
                    <?php echo CHtml::link(
                        'Cancel',
                        array('notes/index','id'=>$parentId),
                        array('class'=>'btn btn-white btn-lg')
                    );?>
                </form>
            </div>
        </div>
    </div>
</div>