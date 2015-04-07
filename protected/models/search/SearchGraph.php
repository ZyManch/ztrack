<?php

/**
* This is the model class for table "graph".
*
* The followings are the available columns in table 'graph':
    * @property string $id
    * @property string $name
    * @property string $title
    * @property string $engine
    * @property string $is_multy_stat
    * @property string $is_with_history
    * @property string $status
    * @property string $changed
*/
class SearchGraph extends CGraph {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, name, title, engine, is_multy_stat, is_with_history, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('engine',$this->engine,true);
		$criteria->compare('is_multy_stat',$this->is_multy_stat,true);
		$criteria->compare('is_with_history',$this->is_with_history,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('Graph', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
