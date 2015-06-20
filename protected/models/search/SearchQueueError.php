<?php

/**
* This is the model class for table "queue_error".
*
* The followings are the available columns in table 'queue_error':
    * @property string $id
    * @property string $item
    * @property string $eta
*/
class SearchQueueError extends CQueueError {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, item, eta', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('eta',$this->eta,true);

        return new CActiveDataProvider('QueueError', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
