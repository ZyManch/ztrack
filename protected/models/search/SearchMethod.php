<?php

/**
* This is the model class for table "method".
*
* The followings are the available columns in table 'method':
    * @property string $id
    * @property string $title
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Request[] $requests
    */
class SearchMethod extends CMethod {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, title, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('Method', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
