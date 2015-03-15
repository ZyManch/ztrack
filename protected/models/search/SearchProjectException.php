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
class SearchProjectException extends CProjectException {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, title, level_id, total_count, trace_file, trace_line, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title);
		$criteria->compare('level_id',$this->level_id,true);
		$criteria->compare('total_count',$this->total_count,true);
		$criteria->compare('trace_file',$this->trace_file,true);
		$criteria->compare('trace_line',$this->trace_line);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('ProjectException', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
