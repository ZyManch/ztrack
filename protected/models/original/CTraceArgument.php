<?php

/**
* This is the model class for table "trace_argument".
*
* The followings are the available columns in table 'trace_argument':
    * @property string $id
    * @property string $trace_id
    * @property string $name
    * @property integer $position
    * @property string $value
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property Trace $trace
*/
class CTraceArgument extends ActiveRecord {

    public function tableName()	{
        return 'trace_argument';
    }

    public function rules()	{
        return array(
            array('trace_id, position, value', 'required'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('trace_id', 'length', 'max'=>10),
			array('name', 'length', 'max'=>64),
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
            'name' => 'Name',
            'position' => 'Position',
            'value' => 'Value',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
