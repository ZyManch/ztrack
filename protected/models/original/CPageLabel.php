<?php

/**
 * This is the model class for table "page_label".
 *
 * The followings are the available columns in table 'page_label':
 * @property string $id
 * @property string $page_id
 * @property string $label_id
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property Page $page
 * @property Label $label
 */
class CPageLabel extends ActiveRecord {

	public function tableName()	{
		return 'page_label';
	}

	public function rules()	{
		return array(
			array('page_id, label_id, changed', 'required'),
			array('page_id, label_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, page_id, label_id, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'page' => array(self::BELONGS_TO, 'Page', 'page_id'),
			'label' => array(self::BELONGS_TO, 'Label', 'label_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'page_id' => 'Page',
			'label_id' => 'Label',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}


}
