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
        if (!$model->parentPage && !$model->parentPage->canChangeProgress()) {
            $parent = $model->parentPage;
            $childs = $parent->getRelated('pages',true,array('resetScope'=>true));
            $totalProgress = count($childs);

        }
    }


}