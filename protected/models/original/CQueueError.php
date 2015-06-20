<?php

/**
* This is the model class for table "queue_error".
*
* The followings are the available columns in table 'queue_error':
    * @property string $id
    * @property string $item
    * @property string $eta
*/
class CQueueError extends ActiveRecord {

    public function tableName()	{
        return 'queue_error';
    }

    public function rules()	{
        return array(
            array('eta', 'required'),
			array('eta', 'length', 'max'=>10),
			array('item', 'safe')        );
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
            'item' => 'Item',
            'eta' => 'Eta',
        );
    }


}
