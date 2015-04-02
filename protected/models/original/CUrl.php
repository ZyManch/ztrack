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
            array('domain, url', 'required'),
			array('protocol', 'length', 'max'=>5),
			array('domain', 'length', 'max'=>200),
			array('status', 'length', 'max'=>7)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
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
