<?php

/**
* This is the model class for table "page_type".
*
* The followings are the available columns in table 'page_type':
    * @property string $id
    * @property string $constant
    * @property string $title
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Page[] $pages
    */
class SearchPageType extends CPageType {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, constant, title, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('constant',$this->constant,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('PageType', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
