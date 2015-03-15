<?php

/**
* This is the model class for table "server".
*
* The followings are the available columns in table 'server':
    * @property string $id
    * @property string $title
    * @property string $company_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Request[] $requests
            * @property Company $company
    */
class SearchServer extends CServer {

public function search() {

$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

return new CActiveDataProvider($this, array(
'criteria'=>$criteria,
'pagination'=>array('pageSize'=>40)
));
}

}
