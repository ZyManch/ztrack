<?php

/**
* This is the model class for table "os".
*
* The followings are the available columns in table 'os':
    * @property string $id
    * @property string $os
    * @property string $name
    * @property string $version
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Request[] $requests
    */
class SearchOs extends COs {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, os, name, version, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('os',$this->os,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('Os', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
