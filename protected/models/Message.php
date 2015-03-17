<?php

/**
* This is the model class for table "message".
*
* The followings are the available columns in table 'message':
 * @property $pageMessage PageMessage
 * @property $userMessage UserMessage
*/
class Message extends CMessage {

    public function behaviors() {
        return array_merge(
            parent::behaviors(),
            array(
                'fillCreateColumn' => array(
                    'class' => 'FillCreateColumnBehavior'
                )
            )
        );
    }

    protected function _extendedRelations() {
        return array(
            'pageMessage' => array(self::HAS_ONE, 'PageMessage', 'message_id'),
            'userMessage' => array(self::HAS_ONE, 'UserMessage', 'message_id'),
        );
    }

    public function getBodyAsHtml() {
        return Yii::app()->user->getEditor()->parse($this->body);
    }

}
