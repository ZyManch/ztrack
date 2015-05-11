<?php

/**
* This is the model class for table "messenger".
*
* The followings are the available columns in table 'messenger':
    * @property string $id
    * @property string $type
    * @property string $title
    * @property string $status
    * @property string $changed
*/
class CMessenger extends ActiveRecord {

    public function tableName()	{
        return 'messenger';
    }

    public function rules()	{
        return array(
            array('type, title', 'required'),
			array('type', 'length', 'max'=>16),
			array('title', 'length', 'max'=>64),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'type' => 'Type',
            'title' => 'Title',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
