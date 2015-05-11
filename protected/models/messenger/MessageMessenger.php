<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 11.05.2015
 * Time: 16:50
 */
class MessageMessenger extends AbstractMessenger {


    function send($title, $body, User $toUser, User $fromUser = null) {
        $message = new Message();
        if ($fromUser) {
            $message->user_id = $fromUser->id;
        }
        $message->body = $body;
        $message->created = date('Y-m-d H:i:s',DateFormatter::getCurrentTimestamp());
        if (!$message->save()) {
            throw new Exception('Error create message: '.$message->getErrorsAsText());
        }
        $link = new UserMessage();
        $link->user_id = $toUser->id;
        $link->message_id = $message->id;
        $link->save(false);
    }

}