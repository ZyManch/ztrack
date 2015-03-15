<?php

/**
* This is the model class for table "request".
*
* The followings are the available columns in table 'request':
    * @property string $id
    * @property string $browser_id
    * @property string $os_id
    * @property string $user_ip
    * @property string $code
    * @property string $method_id
    * @property string $url_id
    * @property string $referer_url_id
    * @property string $server_id
    * @property string $branch_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Branch $branch
            * @property Url $url
            * @property Method $method
            * @property Server $server
            * @property Url $refererUrl
            * @property Browser $browser
            * @property Os $os
            * @property RequestData[] $requestDatas
            * @property Trace[] $traces
    */
class SearchRequest extends CRequest {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, browser_id, os_id, user_ip, code, method_id, url_id, referer_url_id, server_id, branch_id, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('browser_id',$this->browser_id,true);
		$criteria->compare('os_id',$this->os_id,true);
		$criteria->compare('user_ip',$this->user_ip,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('method_id',$this->method_id,true);
		$criteria->compare('url_id',$this->url_id,true);
		$criteria->compare('referer_url_id',$this->referer_url_id,true);
		$criteria->compare('server_id',$this->server_id,true);
		$criteria->compare('branch_id',$this->branch_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('Request', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
