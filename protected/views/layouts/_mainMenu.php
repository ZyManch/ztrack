<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 08.03.2015
 * Time: 1:07
 * @var $this Controller
 */
?>
<div id="main-menu" role="navigation">
<div id="main-menu-inner">
<ul class="navigation">
    <?php foreach (Yii::app()->user->getUser()->systemModules as $systemModule):?>
        <?php foreach ($systemModule->getMainMenuItems() as $menu):?>
            <?php $this->renderPartial('//layouts/_mainMenuItem',array('menu'=>$menu));?>
        <?php endforeach;?>
    <?php endforeach;?>
</ul> <!-- / .navigation -->
<div class="menu-content">
    <a href="pages-invoice.html" class="btn btn-primary btn-block btn-outline dark">Create Invoice</a>
</div>
</div> <!-- / #main-menu-inner -->
</div> <!-- / #main-menu -->
