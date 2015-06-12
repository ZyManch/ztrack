<?php

/**
* This is the model class for table "environment".
*
* The followings are the available columns in table 'environment':
    * @property string $id
    * @property string $title
    * @property string $company_id
    * @property string $status
*/
class SearchEnvironment extends CEnvironment {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, title, company_id, status', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('status',$this->status,true);

        return new CActiveDataProvider('Environment', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
