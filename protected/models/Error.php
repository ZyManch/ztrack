<?php

/**
* This is the model class for table "error".
*
* The followings are the available columns in table 'error':
*/
class Error extends CError {

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


}
