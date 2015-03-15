<?php

/**
* This is the model class for table "page_label".
*
* The followings are the available columns in table 'page_label':
    * @property string $id
    * @property string $page_id
    * @property string $label_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Page $page
            * @property Label $label
    */
class SearchPageLabel extends CPageLabel {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, page_id, label_id, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('page_id',$this->page_id,true);
		$criteria->compare('label_id',$this->label_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('PageLabel', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
