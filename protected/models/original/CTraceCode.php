<?php

/**
* This is the model class for table "trace_code".
*
* The followings are the available columns in table 'trace_code':
    * @property string $id
    * @property string $trace_id
    * @property integer $line
    * @property string $code
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Trace $trace
*/
class CTraceCode extends ActiveRecord {

    public function tableName()	{
        return 'trace_code';
    }

    public function rules()	{
        return array(
            array('trace_id, line, code', 'required'),
			array('line', 'numerical', 'integerOnly'=>true),
			array('trace_id', 'length', 'max'=>10),
			array('code', 'length', 'max'=>255),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'trace' => array(self::BELONGS_TO, 'Trace', 'trace_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'trace_id' => 'Trace',
            'line' => 'Line',
            'code' => 'Code',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
