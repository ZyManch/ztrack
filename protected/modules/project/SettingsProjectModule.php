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
                    'actions' => array('index'),
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
            Yii::app()->controller->redirect(array(
                'project/view',
                'id'=>$project->id,
                'module'=>'settings'
            ));
        }
        Yii::app()->controller->renderPartial(
            '//modules/project/_settings',
            array(
                'project' => $project,
                'settings' => $this->_getAllSettings(),
            )
        );
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

    protected function _getProject() {
        $projectId = Yii::app()->request->getParam('id');
        return Project::model()->findByPk($projectId);
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