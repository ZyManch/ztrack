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
class CBrowser extends ActiveRecord {

	public function tableName()	{
		return 'browser';
	}

	public function rules()	{
		return array(
			array('browser, changed', 'required'),
			array('browser', 'length', 'max'=>255),
			array('name, version', 'length', 'max'=>32),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, browser, name, version, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'requests' => array(self::HAS_MANY, 'Request', 'browser_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'browser' => 'Browser',
			'name' => 'Name',
			'version' => 'Version',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}


}
