<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 15.04.2015
 * Time: 18:02
 */
require_once(Yii::getPathOfAlias('application.extensions.tabgeo_country_v4.tabgeo_country_v4').'.php');
class CountryBehavior extends CActiveRecordBehavior {

    const DEFAULT_COUNTRY_CODE = 'EX';

    public $ip_field_name = 'user_ip';
    public $country_field_name = 'country_id';

    /**
     * @param CModelEvent $event event parameter
     * @throws Exception
     */
    public function beforeSave($event = null) {
        $model = $event->sender;
        $key = $this->ip_field_name;
        $countryCode = tabgeo_country_v4(long2ip($model->$key));
        $country = Country::model()->findByAttributes(array('code'=>$countryCode));
        if (!$country) {
            $country = Country::model()->findByAttributes(array('code'=>self::DEFAULT_COUNTRY_CODE));
        }
        if (!$country) {
            throw new Exception('Default country '.self::DEFAULT_COUNTRY_CODE.' not found');
        }
        $key = $this->country_field_name;
        $model->$key = $country->id;
    }
}