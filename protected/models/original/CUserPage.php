<?php

/**
* This is the model class for table "user_page".
*
* The followings are the available columns in table 'user_page':
    * @property string $id
    * @property string $user_id
    * @property string $page_id
    * @property string $is_assigned
    * @property integer $position
    *
    * The followings are the available model relations:
        * @property User $user
        * @property Page $page
*/
class CUserPage extends ActiveRecord {

    public function tableName()	{
        return 'user_page';
    }

    public function rules()	{
        return array(
            array('user_id, page_id, position', 'required'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('user_id, page_id', 'length', 'max'=>11),
			array('is_assigned', 'length', 'max'=>3)        );
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
            'is_assigned' => 'Is Assigned',
            'position' => 'Position',
        );
    }


}
