<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 08.03.2015
 * Time: 20:29
 * @var $this Controller
 * @var $project array
 * @var $model Project
 */
$model = $project['project'];
$url =  CHtml::normalizeUrl(array('project/view','id' => $model->id));
?>

<?php if (isset($project['items']) && $project['items']):?>
    <li class="mm-dropdown">
        <a href="<?php echo CHtml::normalizeUrl($url);?>">
            <i class="menu-icon fa fa-th"></i>
            <span class="mm-text">Layouts</span>
        </a>
        <ul>
            <?php foreach ($project['items'] as $item):?>
                <?php $this->renderPartial('//layouts/_mainMenuItem',array('project'=>$item));?>
            <?php endforeach;?>
        </ul>
    </li>
<?php else:?>
    <li>
        <a href="<?php echo CHtml::normalizeUrl($url);?>">
            <i class="menu-icon fa fa-dashboard"></i>
            <span class="mm-text">
                <?php echo CHtml::encode($model->title);?>
            </span>
        </a>
    </li>
<?php endif;?>