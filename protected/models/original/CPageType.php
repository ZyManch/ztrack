<?php

/**
 * This is the model class for table "page_type".
 *
 * The followings are the available columns in table 'page_type':
 * @property string $id
 * @property string $constant
 * @property string $title
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property Page[] $pages
 */
class CPageType extends ActiveRecord {

	public function tableName()	{
		return 'page_type';
	}

	public function rules()	{
		return array(
			array('constant, title, changed', 'required'),
			array('constant, title', 'length', 'max'=>64),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, constant, title, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	protected function _baseRelations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'pages' => array(self::HAS_MANY, 'Page', 'page_type_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'constant' => 'Constant',
			'title' => 'Title',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}


}
