<?php

/**
* This is the model class for table "user_access".
*
* The followings are the available columns in table 'user_access':
    * @property string $id
    * @property string $user_id
    * @property string $access_id
    * @property string $project_id
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property User $user
            * @property Access $access
            * @property Project $project
    */
class SearchUserAccess extends CUserAccess {

public function search() {

$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('access_id',$this->access_id,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

return new CActiveDataProvider($this, array(
'criteria'=>$criteria,
'pagination'=>array('pageSize'=>40)
));
}

}
