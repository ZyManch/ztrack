<?php

/**
* This is the model class for table "access".
*
* The followings are the available columns in table 'access':
    * @property string $id
    * @property string $company_id
    * @property string $title
    * @property string $access
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Company $company
            * @property GroupAccess[] $groupAccesses
            * @property UserAccess[] $userAccesses
    */
class CAccess extends ActiveRecord {

public function tableName()	{
return 'access';
}

public function rules()	{
return array(
    array('title, access, changed', 'required'),
    array('company_id', 'length', 'max'=>10),
    array('title', 'length', 'max'=>32),
    array('status', 'length', 'max'=>7),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
array('id, company_id, title, access, status, changed', 'safe', 'on'=>'search'),
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
    'groupAccesses' => array(self::HAS_MANY, 'GroupAccess', 'access_id'),
    'userAccesses' => array(self::HAS_MANY, 'UserAccess', 'access_id'),
);
}

public function attributeLabels() {
return array(
    'id' => 'ID',
    'company_id' => 'Company',
    'title' => 'Title',
    'access' => 'Access',
    'status' => 'Status',
    'changed' => 'Changed',
);
}


}
