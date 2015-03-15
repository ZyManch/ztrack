<?php

/**
* This is the model class for table "system_module".
*
* The followings are the available columns in table 'system_module':
    * @property string $id
    * @property string $name
    * @property string $title
    * @property string $description
    * @property string $type
    * @property string $installation
    * @property integer $position
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property GuestSystemModule[] $guestSystemModules
            * @property ProjectSystemModule[] $projectSystemModules
            * @property UserSystemModule[] $userSystemModules
    */
class SearchSystemModule extends CSystemModule {

public function search() {

$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('installation',$this->installation,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

return new CActiveDataProvider($this, array(
'criteria'=>$criteria,
'pagination'=>array('pageSize'=>40)
));
}

}