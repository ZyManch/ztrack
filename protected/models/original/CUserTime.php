<?php

/**
* This is the model class for table "user_time".
*
* The followings are the available columns in table 'user_time':
    * @property string $id
    * @property string $user_id
    * @property string $page_id
    * @property string $description
    * @property string $started
    * @property string $finished
    * @property integer $duration
    *
    * The followings are the available model relations:
        * @property User $user
        * @property Page $page
*/
class CUserTime extends ActiveRecord {

    public function tableName()	{
        return 'user_time';
    }

    public function rules()	{
        return array(
            array('user_id, description, started', 'required'),
			array('duration', 'numerical', 'integerOnly'=>true),
			array('user_id, page_id', 'length', 'max'=>10),
			array('finished', 'safe')        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'page' => array(self::BELONGS_TO, 'Page', 'page_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'page_id' => 'Page',
            'description' => 'Description',
            'started' => 'Started',
            'finished' => 'Finished',
            'duration' => 'Duration',
        );
    }


}
