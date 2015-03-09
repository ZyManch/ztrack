<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 11:10
 */
?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
        <?php echo CHtml::image(
            'http://www.gravatar.com/avatar/'.
            md5(strtolower( trim( Yii::app()->user->getUser()->email ) ) ).
            '?s=25&d=mm&r=g'
        );?>
        <span><?php echo CHtml::encode(Yii::app()->getUser()->getName());?></span>
    </a>
    <ul class="dropdown-menu">
        <li><a href="#"><span class="label label-warning pull-right">New</span>Profile</a></li>
        <li><a href="#"><span class="badge badge-primary pull-right">New</span>Account</a></li>
        <li><a href="#"><i class="dropdown-icon fa fa-cog"></i>&nbsp;&nbsp;Settings</a></li>
        <li class="divider"></li>
        <li><a href="/site/logout"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
    </ul>
</li>