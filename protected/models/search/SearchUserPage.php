<?php

/**
* This is the model class for table "user_page".
*
* The followings are the available columns in table 'user_page':
    * @property string $id
    * @property string $user_id
    * @property string $page_id
    * @property string $is_assigned
    *
    * The followings are the available model relations:
            * @property User $user
            * @property Page $page
    */
class SearchUserPage extends CUserPage {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, user_id, page_id, is_assigned', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('page_id',$this->page_id,true);
		$criteria->compare('is_assigned',$this->is_assigned,true);

        return new CActiveDataProvider('UserPage', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
