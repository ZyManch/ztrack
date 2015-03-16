<?php

/**
* This is the model class for table "message".
*
* The followings are the available columns in table 'message':
*/
class Message extends CMessage {

    public function getBodyAsHtml() {
        return Yii::app()->user->getEditor()->parse($this->body);
    }

}
