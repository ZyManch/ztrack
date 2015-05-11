<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 11.05.2015
 * Time: 16:50
 */
class EmailMessenger extends AbstractMessenger {



    public function send($title, $body, User $toUser, User $fromUser = null) {
        mail($toUser->email,$title,$body);
    }

}