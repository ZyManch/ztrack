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
            * @property Request $request
            * @property Trace $parent
            * @property Trace[] $traces
            * @property TraceArgument[] $traceArguments
            * @property TraceCode[] $traceCodes
    */
class SearchTrace extends CTrace {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, request_id, parent_id, filename, line, method, position, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

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

        return new CActiveDataProvider('Trace', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
