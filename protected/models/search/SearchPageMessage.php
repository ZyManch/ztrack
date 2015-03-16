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
class SearchPageMessage extends CPageMessage {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, page_id, message_id', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('page_id',$this->page_id,true);
		$criteria->compare('message_id',$this->message_id,true);

        return new CActiveDataProvider('PageMessage', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
