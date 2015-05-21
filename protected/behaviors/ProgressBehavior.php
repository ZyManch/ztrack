<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 02.04.2015
 * Time: 10:30
 */
class ProgressBehavior extends CActiveRecordBehavior  {

    public function beforeSave($event) {
        /** @var Page $model */
        $model = $event->sender;
        if (!$this->_haveProgressLogic($model)) {
            return true;
        }
        if ($model->progress == 100) {
            $model->status = ActiveRecord::STATUS_CLOSED;
        } else {
            $model->status = ActiveRecord::STATUS_ACTIVE;
        }
        return true;
    }

    public function afterSave($event) {
        /** @var Page $model */
        $model = $event->sender;
        if (!$this->_haveProgressLogic($model)) {
            return true;
        }
        if (!$model->parentPage) {
            return true;
        }
        $parent = $model->parentPage;
        /** @var Page[] $childs */
        $childs = $parent->pages;
        $maxProgress = sizeof($childs) * 100;
        $totalProgress = 0;
        foreach ($childs as $child) {
            $totalProgress+=$child->getProgressValue();
        }
        $parent->progress = $maxProgress ? round(100*$totalProgress / $maxProgress) : 0;
        $parent->save(false);
        return true;
    }

    protected function _haveProgressLogic(Page $model) {
        return in_array($model->page_type_id,array(PAGE_TYPE_RELEASE,PAGE_TYPE_TICKETS));
    }


}