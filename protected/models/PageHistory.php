<?php

/**
* This is the model class for table "page_history".
*
* The followings are the available columns in table 'page_history':
*/
class PageHistory extends CPageHistory {

    public function behaviors() {
        return array_merge(
            parent::behaviors(),
            array(
                'fillCreateColumn' => array(
                    'class' => 'FillCreateColumnBehavior'
                ),
            )
        );
    }

    public function getChangesAttributes() {
        $result = array();
        if (!$this->previousPageHistory) {
            return $result;
        }
        foreach (self::getAttributesThatCanChange() as $attribute) {
            if ($this->$attribute != $this->previousPageHistory->$attribute) {
                $result[] = $attribute;
            }
        }
        return $result;
    }

    public static function getAttributesThatCanChange() {
        return array(
            'assign_user_id',
            'project_id',
            'title',
            'body',
            'progress',
            'level_id',
            'status',
        );
    }

}
