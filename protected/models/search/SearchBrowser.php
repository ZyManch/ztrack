<?php

/**
* This is the model class for table "browser".
*
* The followings are the available columns in table 'browser':
    * @property string $id
    * @property string $browser
    * @property string $name
    * @property string $version
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Request[] $requests
    */
class SearchBrowser extends CBrowser {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, browser, name, version, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('browser',$this->browser,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('Browser', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
