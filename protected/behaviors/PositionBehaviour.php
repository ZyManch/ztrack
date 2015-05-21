<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 21.05.2015
 * Time: 17:46
 */
class PositionBehaviour extends CActiveRecordBehavior {

    public $parentProperty;
    public $parentPropertyId;

    public $parentChildProperty;

    public function beforeValidate($event) {
        /** @var Page $model */
        $model = $event->sender;
        if (!$model->isNewRecord) {
            return true;
        }

        if (!$this->parentProperty || !$this->parentChildProperty || !$this->parentPropertyId) {
            throw new Exception('Position behaviour have missed params');
        }
        $max = 1;
        $parentProperty = $this->parentProperty;
        $parentChildProperty = $this->parentChildProperty;
        $parentPropertyId = $this->parentPropertyId;
        if ($model->$parentProperty) {
            $oneLevelItems = $model->$parentProperty->$parentChildProperty;
        } else {
            $criteria = new CDbCriteria();
            $criteria->addCondition($parentPropertyId.' is null');
            $oneLevelItems = $model::model()->findAll($criteria);
        }
        foreach ($oneLevelItems as $child) {
            if ($child->position >= $max) {
                $max = $child->position + 1;
            }
        }
        $model->position = $max;
        return true;

    }
}