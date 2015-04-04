<?php

/**
* This is the model class for table "group_statistic".
*
* The followings are the available columns in table 'group_statistic':
    * @property string $id
    * @property string $group_id
    * @property string $statistic_id
    *
    * The followings are the available model relations:
        * @property Group $group
        * @property Statistic $statistic
*/
class CGroupStatistic extends ActiveRecord {

    public function tableName()	{
        return 'group_statistic';
    }

    public function rules()	{
        return array(
            array('group_id, statistic_id', 'required'),
			array('group_id, statistic_id', 'length', 'max'=>10)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
            'statistic' => array(self::BELONGS_TO, 'Statistic', 'statistic_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'group_id' => 'Group',
            'statistic_id' => 'Statistic',
        );
    }


}
