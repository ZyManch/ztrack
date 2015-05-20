<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 19.05.2015
 * Time: 14:16
 * @var $model User
 * @var $modules SystemModule[]
 */
$isMe = (Yii::app()->user->id == $model->id);
Yii::app()->clientScript->registerScript(
    'modules',
    sprintf(
        '$(".system-modules input").change(function() {
            var $this = $(this),
                $parent = $this.parents(".module");
            if($this.is(":checked")) {
                $parent.addClass("checked");
                $.ajax({
                    url: "%s",
                    method: "POST",
                    data: {system_module_id: $this.data("module")}
                });
            } else {
                $parent.removeClass("checked");
                $.ajax({
                    url: "%s",
                    method: "POST",
                    data: {system_module_id: $this.data("module")}
                });
            }
        });',
        CHtml::normalizeUrl(array('user/addUserModule','id'=>$model->id)),
        CHtml::normalizeUrl(array('user/removeUserModule','id'=>$model->id))
    )
);
?>
<table class="table system-modules checkbox-list">
    <tbody>
    <?php foreach ($modules as $systemModule):?>
        <tr>

            <td class="checkbox-item module<?php if (isset($model->systemModules[$systemModule->id])):?> checked<?php endif;?>">
                <label>
                    <?php echo CHtml::encode($systemModule->title);?>
                    <?php if($isMe):?>
                        <input type="checkbox" data-module="<?php echo $systemModule->id;?>" <?php if (isset($model->systemModules[$systemModule->id])):?>checked="checked" <?php endif;?>/>
                    <?php endif;?>
                </label>
            </td>
        </tr>
    <?php endforeach;?>
    <?php if (!$modules):?>
        Empty
    <?php endif;?>
    </tbody>
</table>