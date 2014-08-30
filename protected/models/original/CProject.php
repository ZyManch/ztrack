<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property string $id
 * @property string $title
 * @property string $parent_id
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property GroupAccess[] $groupAccesses
 * @property CProject $parent
 * @property CProject[] $projects
 * @property UserAccess[] $userAccesses
 */
class CProject extends ActiveRecord {

	public function tableName()	{
		return 'project';
	}

	public function rules()	{
		return array(
			array('title, changed', 'required'),
			array('title', 'length', 'max'=>64),
			array('parent_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, parent_id, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'groupAccesses' => array(self::HAS_MANY, 'GroupAccess', 'project_id'),
			'parent' => array(self::BELONGS_TO, 'CProject', 'parent_id'),
			'projects' => array(self::HAS_MANY, 'CProject', 'parent_id'),
			'userAccesses' => array(self::HAS_MANY, 'UserAccess', 'project_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'parent_id' => 'Parent',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}
