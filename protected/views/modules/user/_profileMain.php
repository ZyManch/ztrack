<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 16:29
 */
?>
<li class="nav-header">
    <div class="dropdown profile-element"> <span>
        <?php echo Yii::app()->user->getUser()->getGravatarImage(48);?>

        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <span class="clear">
                <span class="block m-t-xs">
                    <strong class="font-bold"><?php echo CHtml::encode(Yii::app()->getUser()->getName());?></strong>
                </span>
                <span class="text-muted text-xs block">Profile <b class="caret"></b></span>
            </span>
        </a>
        <ul class="dropdown-menu animated fadeInRight m-t-xs">
            <li><a href="profile.html">Profile</a></li>
            <li><a href="contacts.html">Contacts</a></li>
            <li><a href="mailbox.html">Mailbox</a></li>
            <li class="divider"></li>
            <li><a href="login.html">Logout</a></li>
        </ul>
    </div>
    <div class="logo-element">
        IN+
    </div>
</li>