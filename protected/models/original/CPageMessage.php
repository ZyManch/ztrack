<?php

/**
* This is the model class for table "page_message".
*
* The followings are the available columns in table 'page_message':
    * @property string $id
    * @property string $page_id
    * @property string $message_id
    *
    * The followings are the available model relations:
        * @property Page $page
        * @property Message $message
*/
class CPageMessage extends ActiveRecord {

    public function tableName()	{
        return 'page_message';
    }

    public function rules()	{
        return array(
            array('page_id, message_id', 'required'),
			array('page_id, message_id', 'length', 'max'=>10)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'page' => array(self::BELONGS_TO, 'Page', 'page_id'),
            'message' => array(self::BELONGS_TO, 'Message', 'message_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'page_id' => 'Page',
            'message_id' => 'Message',
        );
    }


}
