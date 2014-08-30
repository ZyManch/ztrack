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



    public function defaultScope() {
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
}