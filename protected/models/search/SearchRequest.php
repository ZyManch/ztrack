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
            array('id, error_id,browser_id, os_id, user_ip, code, method_id, url_id, referer_url_id, server_id, branch_id, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.error_id',$this->error_id);
		$criteria->compare('t.browser_id',$this->browser_id);
		$criteria->compare('t.os_id',$this->os_id);
		$criteria->compare('t.user_ip',$this->user_ip);
		$criteria->compare('t.code',$this->code);
		$criteria->compare('t.method_id',$this->method_id);
		$criteria->compare('t.url_id',$this->url_id);
		$criteria->compare('t.referer_url_id',$this->referer_url_id);
		$criteria->compare('t.server_id',$this->server_id);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.changed',$this->changed);
        $criteria->with = array(
            'browser',
            'os',
            'method',
            'server',
            'url',
            'refererUrl'
        );
        $criteria->order = 't.changed DESC';
        return new CActiveDataProvider('Request', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
