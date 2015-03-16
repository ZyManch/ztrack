<?php

/**
* This is the model class for table "user_message".
*
* The followings are the available columns in table 'user_message':
    * @property string $id
    * @property string $user_id
    * @property string $message_id
    *
    * The followings are the available model relations:
            * @property User $user
            * @property Message $message
    */
class SearchUserMessage extends CUserMessage {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, user_id, message_id', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('message_id',$this->message_id,true);

        return new CActiveDataProvider('UserMessage', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
