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
class SearchTraceCode extends CTraceCode {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, trace_id, line, code, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('trace_id',$this->trace_id,true);
		$criteria->compare('line',$this->line);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('TraceCode', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
