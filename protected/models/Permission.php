<?php

/**
* This is the model class for table "permission".
*
* The followings are the available columns in table 'permission':
*/
class Permission extends CPermission {


    public function getTree() {
        $criteria = new CDbCriteria();
        $criteria->order = 't.group ASC, t.position ASC';
        $permissions = $this->findAll($criteria);
        return CHtml::listData($permissions,'id','title','group');
    }

}
