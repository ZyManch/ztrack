<?php

/**
* This is the model class for table "page_error".
*
* The followings are the available columns in table 'page_error':
    * @property string $id
    * @property string $error_id
    * @property string $page_id
    *
    * The followings are the available model relations:
            * @property Error $error
            * @property Page $page
    */
class SearchPageError extends CPageError {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, error_id, page_id', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('error_id',$this->error_id,true);
		$criteria->compare('page_id',$this->page_id,true);

        return new CActiveDataProvider('PageError', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
