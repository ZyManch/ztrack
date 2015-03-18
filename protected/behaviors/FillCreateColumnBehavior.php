<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.03.2015
 * Time: 19:31
 */
class FillCreateColumnBehavior extends CActiveRecordBehavior  {

    public function beforeValidate($event) {
        $model = $event->sender;
        if (!$model->created) {
            $model->created = date('Y-m-d H:i:s',DateFormatter::getCurrentTimestamp());
        }
        return true;
    }

    public function beforeSave($event) {
        $model = $event->sender;
        if (!$model->created) {
            $model->created = date('Y-m-d H:i:s',DateFormatter::getCurrentTimestamp());
        }
        return true;
    }
}