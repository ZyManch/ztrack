<?php

/**
* This is the model class for table "group".
*
* The followings are the available columns in table 'group':
    * @property string $id
    * @property string $company_id
    * @property string $title
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Company $company
            * @property GroupAccess[] $groupAccesses
            * @property UserGroup[] $userGroups
    */
class CGroup extends ActiveRecord {

public function tableName()	{
return 'group';
}

public function rules()	{
return array(
    array('company_id, title, changed', 'required'),
    array('company_id', 'length', 'max'=>10),
    array('title', 'length', 'max'=>32),
    array('status', 'length', 'max'=>7),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
array('id, company_id, title, status, changed', 'safe', 'on'=>'search'),
);
}

/**
* @return array relational rules.
*/
protected function _baseRelations()	{
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
return array(
    'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
    'groupAccesses' => array(self::HAS_MANY, 'GroupAccess', 'group_id'),
    'userGroups' => array(self::HAS_MANY, 'UserGroup', 'group_id'),
);
}

public function attributeLabels() {
return array(
    'id' => 'ID',
    'company_id' => 'Company',
    'title' => 'Title',
    'status' => 'Status',
    'changed' => 'Changed',
);
}


}
