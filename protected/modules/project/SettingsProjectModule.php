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
                    'actions' => array('index','toggleGroup'),
                    'users'=>array('*'),
                )
            ),
            parent::accessRules()
        );
    }

    public function actionIndex() {
        $project = $this->_getProject();
        if (isset($_POST['modules'])) {
            $this->_saveModules($project, $_POST['modules']);
            $this->redirect(array());
        }
        $groups = $this->_getGroups($project);
        $this->renderPartial(
            '_view',
            array(
                'project' => $project,
                'settings' => $this->_getAllSettings(),
                'groups' => $groups
            )
        );
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

    protected function _saveModules(Project $project, $modules) {
        if (!is_array($modules) || !$modules) {
            $modules = array();
        }
        $systemModules = $this->_getAllSettings();
        $alreadyEnabledModules = $project->systemModules;
        foreach ($systemModules as $systemModule) {
            $alreadyEnabled = isset($alreadyEnabledModules[$systemModule->id]);
            $needEnabled = isset($modules[$systemModule->id]);
            if ($alreadyEnabled && !$needEnabled) {
                $project->removeProjectModule($systemModule);
            } else if ($needEnabled && !$alreadyEnabled) {
                $project->addProjectModule($systemModule);
            }
        }
    }

    /**
     * @param Project $project
     * @return Group[]
     */
    protected function _getGroups(Project $project) {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'groupProjects' => array('on'=>'groupProjects.project_id=:project'),
            'groupProjects.groupProjectModules' => array()
        );
        $criteria->params[':project'] = $project->id;
        $criteria->group = 't.id';
        $criteria->index = 'id';
        return Group::model()->findAll($criteria);
    }


    protected function _getAllSettings() {
        return SystemModule::getSystemModules(
            SystemModule::TYPE_PROJECT,
            array(
                SystemModule::INSTALLATION_INSTALL,
                SystemModule::INSTALLATION_NOT_INSTALL,
            )
        );
    }


}