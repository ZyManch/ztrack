<?php

/**
* This is the model class for table "group_project".
*
* The followings are the available columns in table 'group_project':
*/
class GroupProject extends CGroupProject {


    protected function _extendedRelations() {
        return array(
            'groupProjectModules' => array(self::HAS_MANY, 'GroupProjectModule', 'group_project_id','index'=>'system_module_id'),
        );
    }
}
