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
    array('trace_id, line, code, changed', 'required'),
    array('line', 'numerical', 'integerOnly'=>true),
    array('trace_id', 'length', 'max'=>10),
    array('code', 'length', 'max'=>255),
    array('status', 'length', 'max'=>7),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
array('id, trace_id, line, code, status, changed', 'safe', 'on'=>'search'),
);
}

/**
* @return array relational rules.
*/
protected function _baseRelations()	{
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
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
