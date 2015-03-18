<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 18.03.2015
 * Time: 15:15
 * @var User $user
 * @var $model TicketPage
 */
Yii::app()->clientScript->registerScript(
    'assign_ticket',
    '
    $(".assign-user-to-ticket").click(function() {
        var $this = $(this);
        $this.find(".gravatar-block").slideUp();
        $this.find(".buttons-block").slideDown();
        return false;
    });
    $(".assign-user-to-ticket .btn-cancel").click(function(event) {
        var $link = $(this).parents("a");
        $link.find(".gravatar-block").slideDown();
        $link.find(".buttons-block").slideUp();
        event.stopPropagation();
        return false;
    });
    $(".assign-user-to-ticket .btn-success").click(function(event) {
        var $link = $(this).parents("a");
        location.href = $link.attr("href");
        event.stopPropagation();
        return false;
    });
    '
);
?>
<a class="list-group-item assign-user-to-ticket" href="<?php echo CHtml::encode(CHtml::normalizeUrl(array('project/view','id' => $model->project_id,'module'=>'tickets','action'=>'assign','user_id' => $user->id,'ticket_id'=>$model->id)));?>">
    <h4 class="list-group-item-heading">
        <?php echo $user->username;?>
    </h4>
    <p class="list-group-item-text gravatar-block">
        <?php echo $user->getGravatarImage(64);?>
    </p>
    <p class="list-group-item-text buttons-block" style="display: none">
        <?php echo CHtml::button('Assign',array('class'=>'btn btn-success'));?>
        <?php echo CHtml::button('Cancel',array('class'=>'btn btn-default btn-cancel'));?>
    </p>
</a>