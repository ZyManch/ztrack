<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 18.03.2015
 * Time: 14:59
 * @var $model Page
 */
$isAlreadyAssigned = false;
?>
<?php foreach ($model->userPages as $userPage):?>
    <?php if ($userPage->is_assigned == UserPage::IS_ASSIGNED):?>
        <?php $this->renderPartial('//modules/project/tickets/_ticketAssigned',array('model'=>$model,'user'=>$userPage->user));?>
        <?php $isAlreadyAssigned = true;?>
        <?php $this->renderPartial('//modules/project/tickets/_ticketAssign',array('model'=>$model));?>
    <?php else:?>
        <?php $this->renderPartial('//modules/project/tickets/_ticketUser',array('model'=>$model,'user'=>$userPage->user));?>

    <?php endif;?>
<?php endforeach;?>
<?php if (!$isAlreadyAssigned):?>
    <?php $this->renderPartial('//modules/project/tickets/_ticketAssign',array('model'=>$model));?>
<?php endif;?>