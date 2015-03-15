<?php

/**
* This is the model class for table "branch".
*
* The followings are the available columns in table 'branch':
    * @property string $id
    * @property string $title
    * @property string $company_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Company $company
            * @property Request[] $requests
    */
class SearchBranch extends CBranch {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, title, company_id, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('Branch', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
