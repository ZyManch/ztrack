<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 11.05.2015
 * Time: 16:50
 */
abstract class AbstractMessenger extends Messenger {


    abstract function send($title, $body, User $toUser, User $fromUser = null);
}