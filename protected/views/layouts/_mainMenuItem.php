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

<?php if (isset($menu['items']) && $menu['items']):?>
    <li class="mm-dropdown">
        <a href="<?php echo CHtml::encode($url);?>">
            <i class="menu-icon fa fa-th"></i>
            <span class="mm-text"><?php echo CHtml::encode($menu['label']);?></span>
        </a>
        <ul>
            <?php foreach ($menu['items'] as $item):?>
                <?php $this->renderPartial('//layouts/_mainMenuItem',array('menu'=>$item));?>
            <?php endforeach;?>
        </ul>
    </li>
<?php else:?>
    <li>
        <a href="<?php echo CHtml::encode($url);?>">
            <i class="menu-icon fa fa-dashboard"></i>
            <span class="mm-text">
                <?php echo CHtml::encode($menu['label']);?>
            </span>
        </a>
    </li>
<?php endif;?>