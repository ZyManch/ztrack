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
class CUserMessage extends ActiveRecord {

    public function tableName()	{
        return 'user_message';
    }

    public function rules()	{
        return array(
            array('user_id, message_id', 'required'),
			array('user_id, message_id', 'length', 'max'=>10)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'message' => array(self::BELONGS_TO, 'Message', 'message_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'message_id' => 'Message',
        );
    }


}
