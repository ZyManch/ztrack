<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 19.03.2015
 * Time: 17:34
 */
class PageHistoryBehavior extends CActiveRecordBehavior  {

    protected $_oldAttributes;

    public function afterFind($event) {
        /** @var Page $model */
        $model = $event->sender;
        $this->_oldAttributes = $this->_getModelAttributes($model);
        return true;
    }

    public function afterSave($event) {
        /** @var Page $model */
        $model = $event->sender;
        if ($model->isNewRecord) {
            return true;
        }
        $newAttributes = $this->_getModelAttributes($model);
        if (!$this->_isChanged($newAttributes)) {
            return true;
        }
        $lastHistory = $model->lastHistory;
        $history = new PageHistory();
        $history->attributes = $newAttributes;
        $history->page_id = $model->id;
        $history->user_id = Yii::app()->user->id;
        if ($lastHistory) {
            $history->previous_page_history_id = $lastHistory->id;
        }
        if (!$history->save(false)) {
            Yii::app()->user->setFlash('error','Error save history:'.$history->getErrorsAsText());
        }

        return true;
    }

    protected function _getModelAttributes(Page $model) {
        $attributeList = array(
            'title','body','project_id','progress','level_id','status'
        );
        $attributes = array();
        foreach ($attributeList as $attributeName) {
            $attributes[$attributeName] = $model->$attributeName;
        }
        $assignUserPage = $model->getRelated('assignedUserPage',true);
        $attributes['assign_user_id'] = ($assignUserPage ? $assignUserPage->user_id : null);
        return $attributes;
    }

    protected function _isChanged($newAttributes) {
        if ($newAttributes != $this->_oldAttributes) {
            return true;
        }
        return false;
    }
}