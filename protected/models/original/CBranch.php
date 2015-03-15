<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 * @property string $id
 * @property string $title
 * @property string $company_id
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property Company $company
 * @property Request[] $requests
 */
class CBranch extends ActiveRecord {

	public function tableName()	{
		return 'branch';
	}

	public function rules()	{
		return array(
			array('title, changed', 'required'),
			array('title', 'length', 'max'=>32),
			array('company_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, company_id, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'requests' => array(self::HAS_MANY, 'Request', 'branch_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'company_id' => 'Company',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}


}
