<?php

/**
* This is the model class for table "editor".
*
* The followings are the available columns in table 'editor':
    * @property string $id
    * @property string $name
    * @property string $title
    * @property string $description
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Company[] $companies
    */
class SearchEditor extends CEditor {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, name, title, description, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('Editor', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
