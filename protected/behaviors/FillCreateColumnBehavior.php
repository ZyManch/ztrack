<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.03.2015
 * Time: 19:31
 */
class FillCreateColumnBehavior extends CActiveRecordBehavior  {


    public function beforeSave($event) {
        $model = $event->sender;
        $model->created = time();
        return true;
    }
}