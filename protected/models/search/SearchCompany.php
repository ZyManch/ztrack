<?php

/**
* This is the model class for table "company".
*
* The followings are the available columns in table 'company':
    * @property string $id
    * @property string $title
    * @property string $editor_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Access[] $accesses
            * @property Branch[] $branches
            * @property Editor $editor
            * @property Group[] $groups
            * @property Label[] $labels
            * @property Level[] $levels
            * @property Server[] $servers
            * @property User[] $users
    */
class SearchCompany extends CCompany {

public function search() {

$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('editor_id',$this->editor_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

return new CActiveDataProvider($this, array(
'criteria'=>$criteria,
'pagination'=>array('pageSize'=>40)
));
}

}
