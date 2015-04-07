<?php

/**
* This is the model class for table "graph".
*
* The followings are the available columns in table 'graph':
    * @property string $id
    * @property string $constant
    * @property string $name
    * @property string $title
    * @property string $engine
    * @property string $is_multy_stat
    * @property string $is_with_history
    * @property string $status
    * @property string $changed
*/
class CGraph extends ActiveRecord {

    public function tableName()	{
        return 'graph';
    }

    public function rules()	{
        return array(
            array('constant, name, title', 'required'),
			array('constant, title', 'length', 'max'=>64),
			array('name', 'length', 'max'=>32),
			array('engine', 'length', 'max'=>16),
			array('is_multy_stat, is_with_history', 'length', 'max'=>3),
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
            'constant' => 'Constant',
            'name' => 'Name',
            'title' => 'Title',
            'engine' => 'Engine',
            'is_multy_stat' => 'Is Multy Stat',
            'is_with_history' => 'Is With History',
            'status' => 'Status',
            'changed' => 'Changed',
        );
    }


}
