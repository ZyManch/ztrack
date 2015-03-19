<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 */
class Level extends CLevel {

    const TYPE_PAGE = 'Page';
    const TYPE_EXCEPTION = 'Exception';

    protected static function _getVariantsCriteria($filters = array()) {
        $criteria = new CDbCriteria();
        $criteria->select = 'id, CONCAT("[",weight,"] ",title) as title';
        if ($filters) {
            $criteria->select.=','.implode(',',array_keys($filters));
        }
        $criteria->compare('type',self::TYPE_PAGE);
        $criteria->addCondition('company_id IS NULL OR company_id=:company');
        $criteria->params[':company'] = Yii::app()->user->getUser()->company_id;
        $criteria->order = 'weight ASC';
        return $criteria;
    }
}
