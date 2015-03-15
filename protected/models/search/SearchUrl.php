<?php

/**
* This is the model class for table "url".
*
* The followings are the available columns in table 'url':
    * @property string $id
    * @property string $protocol
    * @property string $domain
    * @property string $url
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Request[] $requests
            * @property Request[] $requests1
    */
class SearchUrl extends CUrl {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, protocol, domain, url, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('protocol',$this->protocol,true);
		$criteria->compare('domain',$this->domain,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('Url', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
