<?php

/**
* This is the model class for table "message".
*
* The followings are the available columns in table 'message':
    * @property string $id
    * @property string $user_id
    * @property integer $body
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property User $user
            * @property PageMessage[] $pageMessages
            * @property UserMessage[] $userMessages
    */
class SearchMessage extends CMessage {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, user_id, body, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('body',$this->body);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('Message', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
