<?php

/**
* This is the model class for table "user_system_module".
*
* The followings are the available columns in table 'user_system_module':
    * @property string $id
    * @property string $user_id
    * @property string $system_module_id
    * @property string $params
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property User $user
            * @property SystemModule $systemModule
    */
class SearchUserSystemModule extends CUserSystemModule {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, user_id, system_module_id, params, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('system_module_id',$this->system_module_id,true);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('UserSystemModule', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
