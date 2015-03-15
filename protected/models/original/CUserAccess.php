<?php

/**
 * This is the model class for table "user_access".
 *
 * The followings are the available columns in table 'user_access':
 * @property string $id
 * @property string $user_id
 * @property string $access_id
 * @property string $project_id
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Access $access
 * @property Project $project
 */
class CUserAccess extends ActiveRecord {

	public function tableName()	{
		return 'user_access';
	}

	public function rules()	{
		return array(
			array('user_id, access_id, project_id, changed', 'required'),
			array('user_id, access_id, project_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, access_id, project_id, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'access' => array(self::BELONGS_TO, 'Access', 'access_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'access_id' => 'Access',
			'project_id' => 'Project',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}


}
