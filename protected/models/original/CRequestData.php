<?php

/**
* This is the model class for table "request_data".
*
* The followings are the available columns in table 'request_data':
    * @property string $id
    * @property string $type
    * @property string $request_id
    * @property string $data
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Request $request
    */
class CRequestData extends ActiveRecord {

public function tableName()	{
return 'request_data';
}

public function rules()	{
return array(
    array('type, request_id, data, changed', 'required'),
    array('type', 'length', 'max'=>32),
    array('request_id', 'length', 'max'=>10),
    array('status', 'length', 'max'=>7),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
array('id, type, request_id, data, status, changed', 'safe', 'on'=>'search'),
);
}

/**
* @return array relational rules.
*/
protected function _baseRelations()	{
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
return array(
    'request' => array(self::BELONGS_TO, 'Request', 'request_id'),
);
}

public function attributeLabels() {
return array(
    'id' => 'ID',
    'type' => 'Type',
    'request_id' => 'Request',
    'data' => 'Data',
    'status' => 'Status',
    'changed' => 'Changed',
);
}


}
