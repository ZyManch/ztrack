<?php

/**
* This is the model class for table "user_time".
*
* The followings are the available columns in table 'user_time':
    * @property string $id
    * @property string $user_id
    * @property string $page_id
    * @property string $description
    * @property string $started
    * @property string $finished
    * @property integer $duration
    *
    * The followings are the available model relations:
            * @property User $user
            * @property Page $page
    */
class SearchUserTime extends CUserTime {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, user_id, page_id, description, started, finished, duration', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('page_id',$this->page_id,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('started',$this->started,true);
		$criteria->compare('finished',$this->finished,true);
		$criteria->compare('duration',$this->duration);

        return new CActiveDataProvider('UserTime', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
