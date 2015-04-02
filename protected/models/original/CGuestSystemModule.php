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
class CGuestSystemModule extends ActiveRecord {

    public function tableName()	{
        return 'guest_system_module';
    }

    public function rules()	{
        return array(
            array('system_module_id', 'required'),
			array('system_module_id', 'length', 'max'=>10),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'systemModule' => array(self::BELONGS_TO, 'SystemModule', 'system_module_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'system_module_id' => 'System Module',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
