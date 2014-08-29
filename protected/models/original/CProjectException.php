<?php

/**
 * This is the model class for table "exception".
 *
 * The followings are the available columns in table 'exception':
 * @property string $id
 * @property integer $title
 * @property string $level_id
 * @property string $total_count
 * @property string $trace_file
 * @property integer $trace_line
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property Level $level
 */
class CProjectException extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'exception';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, level_id, changed', 'required'),
			array('title, trace_line', 'numerical', 'integerOnly'=>true),
			array('level_id, total_count', 'length', 'max'=>10),
			array('trace_file', 'length', 'max'=>200),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, level_id, total_count, trace_file, trace_line, status, changed', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'level' => array(self::BELONGS_TO, 'Level', 'level_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'level_id' => 'Level',
			'total_count' => 'Total Count',
			'trace_file' => 'Trace File',
			'trace_line' => 'Trace Line',
			'status' => 'Status',
			'changed' => 'Changed',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title);
		$criteria->compare('level_id',$this->level_id,true);
		$criteria->compare('total_count',$this->total_count,true);
		$criteria->compare('trace_file',$this->trace_file,true);
		$criteria->compare('trace_line',$this->trace_line);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProjectException the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
