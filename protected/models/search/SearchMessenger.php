<?php

/**
* This is the model class for table "messenger".
*
* The followings are the available columns in table 'messenger':
    * @property string $id
    * @property string $type
    * @property string $title
    * @property string $status
    * @property string $changed
*/
class SearchMessenger extends CMessenger {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, type, title, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('Messenger', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
