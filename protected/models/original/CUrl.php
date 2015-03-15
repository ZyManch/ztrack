<?php

/**
* This is the model class for table "url".
*
* The followings are the available columns in table 'url':
    * @property string $id
    * @property string $protocol
    * @property string $domain
    * @property string $url
    * @property string $status
    * @property string $changed
    *
    * The followings are the available model relations:
            * @property Request[] $requests
            * @property Request[] $requests1
    */
class CUrl extends ActiveRecord {

public function tableName()	{
return 'url';
}

public function rules()	{
return array(
    array('domain, url, changed', 'required'),
    array('protocol', 'length', 'max'=>5),
    array('domain', 'length', 'max'=>200),
    array('status', 'length', 'max'=>7),
// The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
array('id, protocol, domain, url, status, changed', 'safe', 'on'=>'search'),
);
}

/**
* @return array relational rules.
*/
protected function _baseRelations()	{
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
return array(
    'requests' => array(self::HAS_MANY, 'Request', 'url_id'),
    'requests1' => array(self::HAS_MANY, 'Request', 'referer_url_id'),
);
}

public function attributeLabels() {
return array(
    'id' => 'ID',
    'protocol' => 'Protocol',
    'domain' => 'Domain',
    'url' => 'Url',
    'status' => 'Status',
    'changed' => 'Changed',
);
}


}
