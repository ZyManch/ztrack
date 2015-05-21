<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 * @property AbstractProjectModule[] $systemModules
 * @property int $pagesCount
 * @property Group[] $groups
 */
class Project extends CProject {

    public function behaviors() {
        return array_merge(
            parent::behaviors(),
            array(
                'projectSystemModule' => array(
                    'class'=>'ProjectSystemModuleBehavior'
                ),
                'position' => array(
                    'class' => 'PositionBehaviour',
                    'parentProperty' => 'parent',
                    'parentPropertyId' => 'parent_id',
                    'parentChildProperty' => 'projects'
                )
            )
        );
    }

    public function haveSystemModule(AbstractProjectModule $module) {
        foreach ($this->systemModules as $systemModule) {
            if ($module->id == $systemModule->id) {
                return true;
            }
        }
        return false;
    }

    public function addProjectModule(AbstractProjectModule $module) {
        if($module->type != SystemModule::TYPE_PROJECT) {
            return false;
        }
        $module->beforeInstall($this);
        $link = new ProjectSystemModule();
        $link->project_id = $this->id;
        $link->system_module_id = $module->id;
        $link->save(false);
        return true;
    }

    public function removeProjectModule(AbstractProjectModule $module) {
        $module->beforeRemove($this);
        $link = ProjectSystemModule::model()->findByAttributes(array(
            'project_id'=>$this->id,
            'system_module_id' => $module->id
        ));
        if ($link && $module->type == SystemModule::TYPE_PROJECT) {
            $link->delete();
        }
    }

    public function addGroup(Group $group) {
        if (!isset($this->groups[$group->id])) {
            $link = new GroupProject();
            $link->project_id = $this->id;
            $link->group_id = $group->id;
            $link->save(false);
        }
        return true;
    }

    public function removeGroup(Group $group) {
        $link = GroupProject::model()->findByAttributes(array(
            'project_id' => $this->id,
            'group_id' => $group->id
        ));
        if ($link) {
            $link->delete();
        }
        return true;
    }

    public static function sort($projects, $skipIds = array(), $parentProjectId = null) {
        $sortIndex = 0;
        foreach ($projects as $projectParam) {
            /** @var Project $project */
            $project = Project::model()->
                findByAttributes(array(
                    'company_id' => Yii::app()->user->getUser()->company_id,
                    'id' => $projectParam['id']
                ));
            if (!$project) {
                throw new Exception('Project not found: '.json_encode($projectParam));
            }
            if (in_array($project->id, $skipIds)) {
                throw new Exception('Recursive saving');
            }
            $skipIds[] = $project->id;
            if ($project->parent_id != $parentProjectId) {
                $project->parent_id = $parentProjectId;
            }
            if ($project->position !== $sortIndex) {
                $project->position = $sortIndex;
            }
            $project->save(false);
            $sortIndex++;
            if (isset($projectParam['children'])) {
                self::sort($projectParam['children'], $skipIds, $project->id);
            }
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
            if (isset($projects[$this->id])) {
                foreach ($projects[$this->id] as $systemModuleId => $config) {
                    if (isset($modules[$systemModuleId])) {
                        $result[$systemModuleId] = $modules[$systemModuleId];
                    }
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
            'pagesCount' => array(self::STAT, 'Page', 'project_id'),
            'groups' => array(self::MANY_MANY, 'Group','group_project(project_id,group_id)', 'index'=>'id'),
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

    public static function getAllProjectsAsTree($skipProjectIds = array()) {
        $criteria = new CDbCriteria();
        if ($skipProjectIds) {
            $criteria->addNotInCondition('id',$skipProjectIds);
        }
        $projects = Project::model()->findAll($criteria);
        return self::_groupProjectsToTree($projects);
    }


    public static function getProjectsAsTree($projectIds, $skipProjectIds = array()) {
        $projectIds = array_diff($projectIds, $skipProjectIds);
        $projects = Project::model()->findAllByPk($projectIds);
        return self::_groupProjectsToTree($projects);
    }

    protected static function _groupProjectsToTree($projects) {
        $list = array();
        $tree = array();
        $previousSize = 0 ;
        while (sizeof($projects) > 0 && $previousSize !=sizeof($projects)) {
            $previousSize = sizeof($projects);
            foreach ($projects as $key => $project) {
                $item = array(
                    'label' => $project->title,
                    'id' => $project->id,
                    'items' => array()
                );
                $list[$project->id] = &$item;
                if (!$project->parent_id) {
                    $tree[] = &$item;
                    unset($projects[$key]);
                } else if (isset($list[$project->parent_id])) {
                    $list[$project->parent_id]['items'][] = &$item;
                    unset($projects[$key]);
                }
                unset($item);
            }
        }
        return $tree;
    }

    public static function getProjectsAsList($projectIds, $skipProjectIds = array()) {
        $tree = self::getProjectsAsTree($projectIds, $skipProjectIds);
        $result = self::_getProjectsFromTreeAsList($tree);
        return $result;

    }

    protected static function _getProjectsFromTreeAsList($projects,$level = 0) {
        $result = array();
        foreach ($projects as $project) {
            $result[$project['id']] = str_repeat('-',$level).' '.$project['label'];
            if ($project['items']) {
                $items = self::_getProjectsFromTreeAsList($project['items'],$level+1);
                foreach ($items as $key => $item) {
                    $result[$key] = $item;
                }
            }
        }
        return $result;
    }
}
