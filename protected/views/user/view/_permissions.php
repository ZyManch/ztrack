<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 11.05.2015
 * Time: 16:07
 * @var $model User
 * @var $permissions Permissionp[
 */
$canEdit = Yii::app()->user->checkAccess(PERMISSION_USER_MANAGE);
Yii::app()->clientScript->registerScript(
    'permissions',
    sprintf(
        '$(".permissions input").change(function() {
            var $this = $(this),
                $parent = $this.parents(".permission");
            if($this.is(":checked")) {
                $parent.addClass("checked");
                $.ajax({
                    url: "%s",
                    method: "POST",
                    data: {permission_id: $this.data("permission")}
                });
            } else {
                $parent.removeClass("checked");
                $.ajax({
                    url: "%s",
                    method: "POST",
                    data: {permission_id: $this.data("permission")}
                });
            }
        });',
        CHtml::normalizeUrl(array('user/addPermission','id'=>$model->id)),
        CHtml::normalizeUrl(array('user/removePermission','id'=>$model->id))
    )
);
?>
<table class="table  permissions checkbox-list">
    <tbody>
    <?php foreach ($permissions as $group => $groupPermission):?>
        <tr>
            <?php foreach ($groupPermission as $permissionId => $permissionTitle):?>

                <td class="checkbox-item permission<?php if (isset($model->permissions[$permissionId])):?> checked<?php endif;?>">
                    <label>
                        <?php echo $permissionTitle;?>
                        <?php if($canEdit):?>
                            <input type="checkbox" data-permission="<?php echo $permissionId;?>" <?php if (isset($model->permissions[$permissionId])):?>checked="checked" <?php endif;?><?php if ($permissionId == PERMISSION_ROOT && $model->id == Yii::app()->user->id):?> disabled="disabled"<?php endif;?>/>
                        <?php endif;?>
                    </label>
                </td>

            <?php endforeach;?>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>