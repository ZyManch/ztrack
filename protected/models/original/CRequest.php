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
class CRequest extends ActiveRecord {

	public function tableName()	{
		return 'request';
	}

	public function rules()	{
		return array(
			array('browser_id, os_id, user_ip, code, method_id, url_id, branch_id, changed', 'required'),
			array('browser_id, os_id, user_ip, method_id, url_id, server_id, branch_id', 'length', 'max'=>10),
			array('code', 'length', 'max'=>32),
			array('referer_url_id', 'length', 'max'=>11),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, browser_id, os_id, user_ip, code, method_id, url_id, referer_url_id, server_id, branch_id, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'branch' => array(self::BELONGS_TO, 'Branch', 'branch_id'),
			'url' => array(self::BELONGS_TO, 'Url', 'url_id'),
			'method' => array(self::BELONGS_TO, 'Method', 'method_id'),
			'server' => array(self::BELONGS_TO, 'Server', 'server_id'),
			'refererUrl' => array(self::BELONGS_TO, 'Url', 'referer_url_id'),
			'browser' => array(self::BELONGS_TO, 'Browser', 'browser_id'),
			'os' => array(self::BELONGS_TO, 'Os', 'os_id'),
			'requestDatas' => array(self::HAS_MANY, 'RequestData', 'request_id'),
			'traces' => array(self::HAS_MANY, 'Trace', 'request_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'browser_id' => 'Browser',
			'os_id' => 'Os',
			'user_ip' => 'User Ip',
			'code' => 'Code',
			'method_id' => 'Method',
			'url_id' => 'Url',
			'referer_url_id' => 'Referer Url',
			'server_id' => 'Server',
			'branch_id' => 'Branch',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}
