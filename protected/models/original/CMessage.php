<?php

/**
* This is the model class for table "message".
*
* The followings are the available columns in table 'message':
    * @property string $id
    * @property string $user_id
    * @property string $body
    * @property string $status
    * @property string $created
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property User $user
        * @property PageMessage[] $pageMessages
        * @property UserMessage[] $userMessages
*/
class CMessage extends ActiveRecord {

    public function tableName()	{
        return 'message';
    }

    public function rules()	{
        return array(
            array('user_id, body', 'required'),
			array('user_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7),
			array('created', 'safe')        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'pageMessages' => array(self::HAS_MANY, 'PageMessage', 'message_id'),
            'userMessages' => array(self::HAS_MANY, 'UserMessage', 'message_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'body' => 'Body',
            'status' => 'Status',
            'created' => 'Created',
            'changed' => 'Changed',
        );
    }


}
