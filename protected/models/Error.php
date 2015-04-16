<?php

/**
* This is the model class for table "error".
*
* The followings are the available columns in table 'error':
 * @property Request $lastRequest
*/
class Error extends CError {

    protected function _extendedRelations()	{
        return array(
            'lastRequest' => array(self::HAS_ONE, 'Request', 'error_id','order'=>'lastRequest.changed DESC'),
        );
    }

    public function getGroupedOs() {
        $criteria = new CDbCriteria();
        $criteria->compare('requests.error_id',$this->id);
        $criteria->select = array(
            '*',
            'count(requests.id) as count'
        );
        $criteria->group = 't.os';
        $criteria->with = array(
            'requests'
        );
        return Os::model()->findAll($criteria);
    }

    public function getGroupedBrowsers() {
        $criteria = new CDbCriteria();
        $criteria->compare('requests.error_id',$this->id);
        $criteria->select = array(
            '*',
            'count(requests.id) as count'
        );
        $criteria->group = 't.browser';
        $criteria->with = array(
            'requests'
        );
        return Browser::model()->findAll($criteria);
    }

    public function getGroupedByDateRequest() {
        $criteria = new CDbCriteria();
        $criteria->compare('t.error_id',$this->id);
        $criteria->select = array(
            'DATE_FORMAT(t.changed,"%H:00") as changed',
            'count(t.id) as count'
        );
        $criteria->addCondition('t.changed > adddate(now(),interval -12 hour)');
        $criteria->group = 'DATE_FORMAT(t.changed,"%Y%m%d%H") ASC ';
        $result = array();
        $currentHour = date('H',Yii::app()->dateFormatter->getCurrentTimestamp());
        for ($hour = $currentHour-11;$hour <= $currentHour; $hour++) {
            $index = sprintf('%02s:00',($hour<0?$hour+24:$hour));
            $result[$index] = new Request();
            $result[$index]->changed = $index;
            $result[$index]->count = 0;
        }
        /** @var Request[] $requests */
        $requests = Request::model()->findAll($criteria);
        foreach ($requests as $request) {
            $result[$request->changed] = $request;
        }
        return $result;
    }

    public function getGroupedByCountryRequest() {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'country'
        );
        $criteria->compare('t.error_id',$this->id);
        $criteria->select = array(
            'country_id',
            'count(t.id) as count'
        );
        $criteria->group = 't.country_id';
        $result = array();
        /** @var Request[] $requests */
        $requests = Request::model()->findAll($criteria);
        foreach ($requests as $request) {
            $result[$request->country->code] = $request;
        }
        return $result;
    }

    /**
     * @return SearchRequest
     */
    public function getRequestSearch() {
        $requestSearch = new SearchRequest('search');
        $requestSearch->error_id = $this->id;
        return $requestSearch;
    }

}
