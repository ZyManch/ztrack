<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 18.03.2015
 * Time: 15:15
 * @var $user User
 */
?>
<a class="list-group-item active" href="#">
    <h4 class="list-group-item-heading">
        Assigned
        <?php echo $user->username;?>
    </h4>
    <p class="list-group-item-text">
        <?php echo $user->getGravatarImage(64);?>
    </p>
</a>