<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 07.06.14
 * Time: 12:11
 */
class ActiveRecord extends CActiveRecord {

    const STATUS_ACTIVE = 'Active';
    const STATUS_BLOCKED = 'Blocked';
    const STATUS_DELETED = 'Deleted';


    protected function _hasStatus() {
        return isset($this->tableSchema->columnNames['status']);
    }

    public function defaultScope() {
        if (!$this->_hasStatus()) {
            return array();
        }
        $t = $this->getTableAlias(false, false);
        return array(
            'condition' => $t.'.status  = "'.self::STATUS_ACTIVE.'"',
        );
    }

    public function getErrorsAsText() {
        $result = array();
        foreach($this->getErrors() as $key => $errors) {
            $result[] = $key.': '.implode(',',$errors);
        }
        return implode('. ', $result);
    }


    public static function model($className=null) {
        if (is_null($className)) {
            $className = get_called_class();
        }
        return parent::model($className);
    }

    public function delete() {
        if (!$this->_hasStatus()) {
            return parent::delete();
        }
        $this->status = self::STATUS_DELETED;
        return $this->save(false);
    }

    public function relations() {
        return array_merge(
            $this->_baseRelations(),
            $this->_extendedRelations()
        );
    }

    protected function _baseRelations() {
        return array();
    }

    protected function _extendedRelations() {
        return array();
    }

    public static function loadConstants() {
        $cacheKey = 'constants_'.get_called_class();
        if (!isset(Yii::app()->cache[$cacheKey])) {
            $pageTypes = self::model()->findAll();
            $constants = array();
            foreach ($pageTypes as $pageType) {
                $constants[$pageType->constant] = $pageType->id;
            }
            Yii::app()->cache[$cacheKey] = $constants;
        } else {
            $constants = Yii::app()->cache[$cacheKey];
        }
        foreach ($constants as $key => $value) {
            define($key, $value);
        }
    }
}