<?php

/**
* This is the model class for table "country".
*
* The followings are the available columns in table 'country':
    * @property string $id
    * @property string $code
    * @property string $name
    * @property string $region
    *
    * The followings are the available model relations:
            * @property Request[] $requests
    */
class SearchCountry extends CCountry {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, code, name, region', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('region',$this->region,true);

        return new CActiveDataProvider('Country', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
