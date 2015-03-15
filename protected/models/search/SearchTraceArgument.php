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
class SearchTraceArgument extends CTraceArgument {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, trace_id, name, position, value, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('trace_id',$this->trace_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('TraceArgument', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
