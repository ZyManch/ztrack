<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 08.03.2015
 * Time: 20:29
 * @var $this Controller
 * @var $menu array
 */
$url =  CHtml::normalizeUrl($menu['url']);
?>
<?php if (isset($menu['template'])):?>
    <?php $this->renderPartial($menu['template'],isset($menu['attributes']) ? $menu['attributes'] : array());?>
<?php elseif (isset($menu['items']) && $menu['items']):?>
    <li>
        <a href="<?php echo CHtml::encode($url);?>">
            <i class="fa fa-th-large"></i>
            <span class="nav-label"><?php echo CHtml::encode($menu['label']);?></span>
            <span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level">
            <?php foreach ($menu['items'] as $item):?>
                <?php $this->renderPartial('//layouts/_mainMenuItem',array('menu'=>$item));?>
            <?php endforeach;?>
        </ul>
    </li>
<?php else:?>
    <li>
        <a href="<?php echo CHtml::encode($url);?>">
            <i class="fa fa-diamond"></i>
            <span class="nav-label"><?php echo CHtml::encode($menu['label']);?></span>
        </a>
    </li>
<?php endif;?>