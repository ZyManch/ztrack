<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 * @property AbstractProjectModule[] $systemModules
 */
class Project extends CProject {

    public function haveSystemModule(AbstractProjectModule $module) {
        foreach ($this->systemModules as $systemModule) {
            if ($module->id == $systemModule->id) {
                return true;
            }
        }
        return false;
    }

    public function addProjectModule(SystemModule $module) {
        if($module->type != SystemModule::TYPE_PROJECT) {
            return false;
        }
        $link = new ProjectSystemModule();
        $link->project_id = $this->id;
        $link->system_module_id = $module->id;
        $link->save(false);
        return true;
    }

    public function removeProjectModule(SystemModule $module) {
        $link = ProjectSystemModule::model()->findByAttributes(array(
            'project_id'=>$this->id,
            'system_module_id' => $module->id
        ));
        if ($link && $module->type == SystemModule::TYPE_PROJECT) {
            $link->delete();
        }
    }

    public function getEnabledProjectModules(User $user = null) {
        $modules = $this->systemModules;
        foreach (SystemModule::getForceInstalledSystemModules(SystemModule::TYPE_PROJECT) as $module) {
            $modules[$module->id] = $module;
        }
        if (!is_null($user)) {
            $result = array();
            $projects = $user->getAvailableProjects();
            foreach ($projects[$this->id] as $systemModuleId => $config) {
                if (isset($modules[$systemModuleId])) {
                    $result[$systemModuleId] = $modules[$systemModuleId];
                }
            }
            $modules = $result;
        }
        return SystemModule::sort($modules);
    }

    protected function _extendedRelations()	{
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'systemModules' => array(self::MANY_MANY, 'SystemModule', 'project_system_module(project_id,system_module_id)', 'order' => 'systemModules.position ASC','index'=>'id'),
        );
    }

    public function getUsersThatHaveProject() {
        return User::model()->findAll(array(
            'order' => 't.username ASC',
            'params' => array(
                ':PROJECT_ID' => $this->id
            ),
            'with' => array(
                'userGroups' => array(
                    'joinType' => 'inner join',
                    'select' => false,
                ),
                'userGroups.group' => array(
                    'joinType' => 'inner join',
                    'select' => false,
                ),
                'userGroups.group.groupProjects' => array(
                    'joinType' => 'inner join',
                    'select' => false,
                    'on' => 'groupProjects.project_id = :PROJECT_ID'
                )
            )
        ));
    }
}
