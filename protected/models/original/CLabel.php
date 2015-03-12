<?php

/**
 * This is the model class for table "label".
 *
 * The followings are the available columns in table 'label':
 * @property string $id
 * @property string $company_id
 * @property string $title
 * @property string $color
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property Company $company
 * @property PageLabel[] $pageLabels
 */
class CLabel extends ActiveRecord {

	public function tableName()	{
		return 'label';
	}

	public function rules()	{
		return array(
			array('company_id, title, changed', 'required'),
			array('company_id', 'length', 'max'=>10),
			array('title', 'length', 'max'=>32),
			array('color', 'length', 'max'=>6),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, company_id, title, color, status, changed', 'safe', 'on'=>'search'),
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
			'pageLabels' => array(self::HAS_MANY, 'PageLabel', 'label_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'company_id' => 'Company',
			'title' => 'Title',
			'color' => 'Color',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}
