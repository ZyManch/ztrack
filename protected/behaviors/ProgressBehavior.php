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
        if (!in_array($model->page_type_id,array(PAGE_TYPE_RELEASE,PAGE_TYPE_TICKETS))) {
            return true;
        }
        if (!$model->parentPage) {
            return true;
        }
        $parent = $model->parentPage;
        /** @var Page[] $childs */
        $childs = $parent->getRelated('pages',true,array('resetScope'=>true));
        $maxProgress = sizeof($childs) * 100;
        $totalProgress = 0;
        foreach ($childs as $child) {
            $totalProgress+=$child->getProgressValue();
        }
        $parent->progress = round(100*$totalProgress / $maxProgress);
        $parent->save(false);
        return true;
    }


}