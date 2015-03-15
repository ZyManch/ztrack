<?php

/**
* This is the model class for table "request_data".
*
* The followings are the available columns in table 'request_data':
    * @property string $id
    * @property string $type
    * @property string $request_id
    * @property string $data
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Request $request
    */
class SearchRequestData extends CRequestData {

public function search() {

$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('request_id',$this->request_id,true);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

return new CActiveDataProvider($this, array(
'criteria'=>$criteria,
'pagination'=>array('pageSize'=>40)
));
}

}
