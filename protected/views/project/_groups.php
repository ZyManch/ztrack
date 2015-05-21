<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 21.05.2015
 * Time: 16:54
 * @var $groups array
 * @var $model Project
 */
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
        CHtml::normalizeUrl(array('project/addGroup','id'=>$model->id)),
        CHtml::normalizeUrl(array('project/removeGroup','id'=>$model->id))
    )
);
?>
<table class="table groups checkbox-list">
    <tbody>
    <?php foreach ($groups as $groupId => $title):?>
        <tr>

            <td class="checkbox-item group<?php if (isset($model->groups[$groupId])):?> checked<?php endif;?>">
                <label>
                    <?php echo CHtml::encode($title);?>
                    <input type="checkbox" data-group="<?php echo $groupId;?>" <?php if (isset($model->groups[$groupId])):?>checked="checked" <?php endif;?>/>
                </label>
            </td>
        </tr>
    <?php endforeach;?>
    <?php if (!$groups):?>
        Empty
    <?php endif;?>
    </tbody>
</table>