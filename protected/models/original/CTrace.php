<?php

/**
 * This is the model class for table "trace".
 *
 * The followings are the available columns in table 'trace':
 * @property string $id
 * @property string $request_id
 * @property string $parent_id
 * @property string $filename
 * @property integer $line
 * @property integer $method
 * @property string $position
 * @property string $status
 * @property string $changed
 *
 * The followings are the available model relations:
 * @property CTrace $parent
 * @property CTrace[] $traces
 * @property Request $request
 * @property TraceArgument[] $traceArguments
 * @property TraceCode[] $traceCodes
 */
class CTrace extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'trace';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('position, changed', 'required'),
			array('line, method', 'numerical', 'integerOnly'=>true),
			array('request_id, parent_id, position', 'length', 'max'=>10),
			array('filename', 'length', 'max'=>255),
			array('status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, request_id, parent_id, filename, line, method, position, status, changed', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'CTrace', 'parent_id'),
			'traces' => array(self::HAS_MANY, 'CTrace', 'parent_id'),
			'request' => array(self::BELONGS_TO, 'Request', 'request_id'),
			'traceArguments' => array(self::HAS_MANY, 'TraceArgument', 'trace_id'),
			'traceCodes' => array(self::HAS_MANY, 'TraceCode', 'trace_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'request_id' => 'Request',
			'parent_id' => 'Parent',
			'filename' => 'Filename',
			'line' => 'Line',
			'method' => 'Method',
			'position' => 'Position',
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
		$criteria->compare('request_id',$this->request_id,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('line',$this->line);
		$criteria->compare('method',$this->method);
		$criteria->compare('position',$this->position,true);
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
	 * @return CTrace the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
