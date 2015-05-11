<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 18.03.2015
 * Time: 15:04
 * @var $model Page
 */
Yii::app()->clientScript->registerScript(
    'assign_new_user',
    '$(".assign-new-user-to-ticket").click(function() {
        $(this).find(".users").slideToggle();
        return false;
    });
    $(".assign-new-user-to-ticket .btn").click(function(event) {
        var $this=$(this),
            $parent = $this.parent();
        $parent.find(".buttons").show();
        event.stopPropagation();
        return false;
    });
    $(".assign-new-user-to-ticket .assign-ok").click(function(event) {
        var $this=$(this),
            $parent = $this.parents(".user-info");
        event.stopPropagation();
        location.href=$parent.data("url");
        return false;
    });
    $(".assign-new-user-to-ticket .assign-cancel").click(function(event) {
        var $this=$(this),
            $parent = $this.parent();
        $parent.hide();
        event.stopPropagation();
        return false;
    });
    '
);
?>
<a class="list-group-item assign-new-user-to-ticket <?php if (!$model->userPages):?> active<?php endif;?>" href="#">
    <h4 class="list-group-item-heading">
        Assign
    </h4>
    <div class="list-group-item-text users" <?php if ($model->userPages):?>style="display: none"<?php endif;?>>
        <?php foreach ($model->project->getUsersThatHaveProject() as $user):?>
            <div class="user-info" data-url="<?php echo CHtml::encode(CHtml::normalizeUrl(array('project/view','id' => $model->project_id,'module'=>'tickets','action'=>'assign','user_id'=>$user->id,'ticket_id'=>$model->id)));?>">
                <div class="btn btn-white btn-sm btn-block"><?php echo CHtml::encode($user->username);?></div>
                <div class="buttons" style="display: none">
                    <div class="btn btn-white dim assign-cancel col-xs-6"><i class="fa fa-times"></i></div>
                    <div class="btn btn-primary dim assign-ok col-xs-6"><i class="fa fa-check"></i></div>
                </div>
            </div>
            <div class="clearfix"></div>
        <?php endforeach;?>
    </div>
</a>
