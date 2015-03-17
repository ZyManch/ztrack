<?php

/**
* This is the model class for table "user_system_module".
*
* The followings are the available columns in table 'user_system_module':
    * @property string $id
    * @property string $user_id
    * @property string $system_module_id
    * @property string $params
    * @property string $changed
    *
    * The followings are the available model relations:
        * @property User $user
        * @property SystemModule $systemModule
*/
class CUserSystemModule extends ActiveRecord {

    public function tableName()	{
        return 'user_system_module';
    }

    public function rules()	{
        return array(
            array('user_id, system_module_id', 'required'),
			array('user_id, system_module_id', 'length', 'max'=>10),
			array('params', 'safe')        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'systemModule' => array(self::BELONGS_TO, 'SystemModule', 'system_module_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'system_module_id' => 'System Module',
            'params' => 'Params',
            'changed' => 'Changed',
        );
    }


}
