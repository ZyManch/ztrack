<?php

/**
* This is the model class for table "guest_system_module".
*
* The followings are the available columns in table 'guest_system_module':
    * @property string $id
    * @property string $system_module_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property SystemModule $systemModule
    */
class SearchGuestSystemModule extends CGuestSystemModule {

public function search() {

$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('system_module_id',$this->system_module_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

return new CActiveDataProvider($this, array(
'criteria'=>$criteria,
'pagination'=>array('pageSize'=>40)
));
}

}