<?php

/**
* This is the model class for table "group_project".
*
* The followings are the available columns in table 'group_project':
*/
class GroupProject extends CGroupProject {

    public function addProjectModule(AbstractProjectModule $module) {
        if($module->type != SystemModule::TYPE_PROJECT) {
            return false;
        }
        $module->beforeAddAccess($this);
        $link = new GroupProjectModule();
        $link->group_project_id = $this->id;
        $link->system_module_id = $module->id;
        $link->save(false);
        return true;
    }

    public function removeProjectModule(AbstractProjectModule $module) {
        $module->beforeRemoveAccess($this);
        $link = GroupProjectModule::model()->findByAttributes(array(
            'group_project_id'=>$this->id,
            'system_module_id' => $module->id
        ));
        if ($link && $module->type == SystemModule::TYPE_PROJECT) {
            $link->delete();
        }
    }

    protected function _extendedRelations() {
        return array(
            'groupProjectModules' => array(self::HAS_MANY, 'GroupProjectModule', 'group_project_id','index'=>'system_module_id'),
        );
    }
}
