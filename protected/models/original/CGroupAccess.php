<?php

/**
 * This is the model class for table "group_access".
 *
 * The followings are the available columns in table 'group_access':
 * @property string $id
 * @property string $group_id
 * @property string $access_id
 * @property string $project_id
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property Group $group
 * @property Access $access
 * @property Project $project
 */
class CGroupAccess extends ActiveRecord {

	public function tableName()	{
		return 'group_access';
	}

	public function rules()	{
		return array(
			array('group_id, access_id, project_id, changed', 'required'),
			array('group_id, access_id, project_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, group_id, access_id, project_id, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
			'access' => array(self::BELONGS_TO, 'Access', 'access_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'group_id' => 'Group',
			'access_id' => 'Access',
			'project_id' => 'Project',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('access_id',$this->access_id,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}
