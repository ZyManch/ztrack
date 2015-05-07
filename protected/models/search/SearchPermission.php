<?php

/**
* This is the model class for table "permission".
*
* The followings are the available columns in table 'permission':
    * @property string $id
    * @property string $constant
    * @property string $title
    * @property integer $group
    * @property integer $position
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property SystemModule[] $systemModules
            * @property UserPermission[] $userPermissions
    */
class SearchPermission extends CPermission {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, constant, title, group, position, status, changed', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('constant',$this->constant,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('group',$this->group);
		$criteria->compare('position',$this->position);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('changed',$this->changed,true);

        return new CActiveDataProvider('Permission', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
