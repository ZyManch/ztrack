<?php

/**
* This is the model class for table "request".
*
* The followings are the available columns in table 'request':
    * @property string $id
    * @property string $error_id
    * @property string $browser_id
    * @property string $os_id
    * @property string $user_ip
    * @property string $country_id
    * @property string $code
    * @property string $method_id
    * @property string $url_id
    * @property string $referer_url_id
    * @property string $server_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Country $country
        * @property Url $url
        * @property Method $method
        * @property Server $server
        * @property Url $refererUrl
        * @property Browser $browser
        * @property Os $os
        * @property Error $error
        * @property RequestData[] $requestDatas
        * @property Trace[] $traces
*/
class CRequest extends ActiveRecord {

    public function tableName()	{
        return 'request';
    }

    public function rules()	{
        return array(
            array('error_id, browser_id, os_id, user_ip, country_id, code, method_id, url_id', 'required'),
			array('error_id, browser_id, os_id, user_ip, country_id, method_id, url_id, server_id', 'length', 'max'=>10),
			array('code', 'length', 'max'=>32),
			array('referer_url_id', 'length', 'max'=>11),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
            'url' => array(self::BELONGS_TO, 'Url', 'url_id'),
            'method' => array(self::BELONGS_TO, 'Method', 'method_id'),
            'server' => array(self::BELONGS_TO, 'Server', 'server_id'),
            'refererUrl' => array(self::BELONGS_TO, 'Url', 'referer_url_id'),
            'browser' => array(self::BELONGS_TO, 'Browser', 'browser_id'),
            'os' => array(self::BELONGS_TO, 'Os', 'os_id'),
            'error' => array(self::BELONGS_TO, 'Error', 'error_id'),
            'requestDatas' => array(self::HAS_MANY, 'RequestData', 'request_id'),
            'traces' => array(self::HAS_MANY, 'Trace', 'request_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'error_id' => 'Error',
            'browser_id' => 'Browser',
            'os_id' => 'Os',
            'user_ip' => 'User Ip',
            'country_id' => 'Country',
            'code' => 'Code',
            'method_id' => 'Method',
            'url_id' => 'Url',
            'referer_url_id' => 'Referer Url',
            'server_id' => 'Server',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
