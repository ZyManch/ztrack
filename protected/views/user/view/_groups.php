<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 11.05.2015
 * Time: 16:06
 * @var $model User
 * @var $groups Group[]
 */
$canEdit = Yii::app()->user->checkAccess(PERMISSION_USER_MANAGE);
Yii::app()->clientScript->registerScript(
    'groups',
    sprintf(
        '$(".groups input").change(function() {
            var $this = $(this),
                $parent = $this.parents(".group");
            if($this.is(":checked")) {
                $parent.addClass("checked");
                $.ajax({
                    url: "%s",
                    method: "POST",
                    data: {group_id: $this.data("group")}
                });
            } else {
                $parent.removeClass("checked");
                $.ajax({
                    url: "%s",
                    method: "POST",
                    data: {group_id: $this.data("group")}
                });
            }
        });',
        CHtml::normalizeUrl(array('user/addGroup','id'=>$model->id)),
        CHtml::normalizeUrl(array('user/removeGroup','id'=>$model->id))
    )
);
?>
<table class="table groups checkbox-list">
    <tbody>
    <?php foreach ($groups as $group):?>
        <tr>

            <td class="checkbox-item group<?php if (isset($model->groups[$group->id])):?> checked<?php endif;?>">
                <label>
                    <?php echo CHtml::encode($group->title);?>
                    <?php if($canEdit):?>
                        <input type="checkbox" data-group="<?php echo $group->id;?>" <?php if (isset($model->groups[$group->id])):?>checked="checked" <?php endif;?>/>
                    <?php endif;?>
                </label>
            </td>
        </tr>
    <?php endforeach;?>
    <?php if (!$groups):?>
        Empty
    <?php endif;?>
    </tbody>
</table>