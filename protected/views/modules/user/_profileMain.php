<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 16:29
 */
$user = Yii::app()->user->getUser();
?>
<li class="nav-header">
    <div class="dropdown profile-element"> <span>
        <?php echo $user->getGravatarImage(48);?>

        <a href="<?php echo CHtml::normalizeUrl(array('user/view','id'=>$user->id));?>">
            <span class="clear">
                <span class="block m-t-xs">
                    <strong class="font-bold"><?php echo CHtml::encode(Yii::app()->getUser()->getName());?></strong>
                </span>
            </span>
        </a>
    </div>
    <div class="logo-element">
        IN+
    </div>
</li>