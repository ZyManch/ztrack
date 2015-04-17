<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 12:00
 */
class SettingsProjectModule extends AbstractProjectModule {

    public function getModuleName() {
        return 'settings';
    }

    public function getTabs() {
        return array(
            array(
                'label' => 'Settings',
            )
        );
    }

    public function accessRules() {
        return  array_merge(
            array(
                array('allow',
                    'actions' => array('index','delete','save','toggleGroup'),
                    'users'=>array('*'),
                )
            ),
            parent::accessRules()
        );
    }

    public function actionIndex() {
        $project = $this->_getProject();
        $groups = $this->_getGroups($project);
        $this->renderPartial(
            '_view',
            array(
                'project' => $project,
                'modules' => $this->_getAllModules(),
                'groups' => $groups
            )
        );
    }

    public function actionSave() {
        $project = $this->_getProject();
        try {
            $systemModuleId = Yii::app()->request->getParam('system_module_id');
            $systemModule = SystemModule::model()->findByAttributes(array(
                'id' => $systemModuleId,
                'type' => SystemModule::TYPE_PROJECT
            ));
            if (!$systemModule) {
                throw new Exception('System module not found');
            }
            if (!$project->haveSystemModule($systemModule)) {
                $project->addProjectModule($systemModule);
            }
            $newGroups = Yii::app()->request->getParam('groups',array());
            if (!is_array($newGroups)) {
                $newGroups = array();
            }
            $groups = $this->_getGroups($project);
            foreach ($groups as $group) {
                $alreadyEnabled = ($group->groupProject && isset($group->groupProject->groupProjectModules[$systemModule->id]));
                $needEnabled = in_array($modules[$systemModule->id]);
                if ($alreadyEnabled && !$needEnabled) {
                    $project->removeProjectModule($systemModule);
                } else if ($needEnabled && !$alreadyEnabled) {
                    $project->addProjectModule($systemModule);
                }
            }
        } catch (Exception $e) {
            Yii::app()->user->setFlash('error',$e->getMessage());
        }
        $this->redirect(array());
    }

    public function actionDelete() {
        $project = $this->_getProject();
        try {
            $systemModuleId = Yii::app()->request->getParam('system_module_id');
            $systemModule = SystemModule::model()->findByAttributes(array(
                'id' => $systemModuleId,
                'type' => SystemModule::TYPE_PROJECT
            ));
            if (!$systemModule) {
                throw new Exception('System module not found');
            }
            $project->removeProjectModule($systemModule);
        } catch (Exception $e) {
            Yii::app()->user->setFlash('error',$e->getMessage());
        }
        $this->redirect(array());
    }

    public function actionToggleGroup() {
        $project = $this->_getProject();
        $groups = $this->_getGroups($project);
        $groupId = Yii::app()->request->getParam('group_id');
        if (!isset($groups[$groupId])) {
            throw new Exception('Group not found');
        }
        $group = $groups[$groupId];
        if ($group->groupProjects) {
            $group->groupProjects[0]->delete();
        } else {
            $groupProject = new GroupProject();
            $groupProject->group_id = $group->id;
            $groupProject->project_id = $project->id;
            $groupProject->save(false);
        }
        $this->redirect(array('action'=>'index'));
    }

    /**
     * @param Project $project
     * @return Group[]
     */
    protected function _getGroups(Project $project) {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'groupProject' => array('on'=>'groupProject.project_id=:project'),
            'groupProject.groupProjectModules' => array()
        );
        $criteria->params[':project'] = $project->id;
        $criteria->index = 'id';
        return Group::model()->findAll($criteria);
    }


    protected function _getAllModules() {
        return SystemModule::getSystemModules(
            SystemModule::TYPE_PROJECT,
            array(
                SystemModule::INSTALLATION_INSTALL,
                SystemModule::INSTALLATION_NOT_INSTALL,
                SystemModule::INSTALLATION_FORCE,
            )
        );
    }


}