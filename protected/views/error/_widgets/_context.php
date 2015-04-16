<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.04.2015
 * Time: 14:37
 * @var Request $request
 * @var $minLength
 * @var $maxLength
 * @var $shortMode
 */
?>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Context</h5>
    </div>
    <div class="ibox-content">
        <table class="table table-responsive table-bordered">
            <colgroup>
                <col width="150px">
                <col>
            </colgroup>
            <?php $haveRows = false;?>
            <?php foreach ($request->requestDatas as $requestData):?>
                <?php
                $hasMinLength = (!isset($minLength) || strlen($requestData->data) >= $minLength);
                $hasMaxLength = (!isset($maxLength) || strlen($requestData->data) <= $maxLength);
                ?>
                <?php if ($hasMinLength && $hasMaxLength):?>
                    <tr>
                        <?php if ($shortMode):?>
                            <th style="text-align: right"><?php echo CHtml::encode($requestData->type);?></th>
                            <td><?php echo $requestData->getHumanReadableData();?></td>
                        <?php else:?>
                            <td>
                                <strong><?php echo CHtml::encode($requestData->type);?></strong>
                                <?php echo $requestData->getHumanReadableData();?>
                            </td>
                        <?php endif;?>
                    </tr>
                    <?php $haveRows = true;?>
                <?php endif;?>
            <?php endforeach;?>
            <?php if (!$haveRows):?>
                <tr>
                    <td colspan="2">Empty</td>
                </tr>
            <?php endif;?>
        </table>
    </div>
</div>