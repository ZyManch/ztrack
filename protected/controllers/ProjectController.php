<?php

class ProjectController extends Controller {



    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('view'),
                'roles'=>array(PERMISSION_PROJECT_VIEW),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }


    public function actionView($id, $module=null) {
        $model = $this->loadModel($id);
        $user = Yii::app()->user->getUser();
        if (!$module) {
            $userModules = $model->getEnabledProjectModules($user);
            if ($userModules) {
                $module = array_shift($userModules)->name;
            } else {
                $projectModules = $model->getEnabledProjectModules();
                if ($projectModules) {
                    $module = array_shift($projectModules)->name;
                } else if (Yii::app()->user->checkAccess(PERMISSION_PROJECT_MANAGE)) {
                    Yii::app()->user->setErrorFlash(
                        'project',
                        'Need install minimum one of module'
                    );
                    $this->redirect(array(
                        'module/view',
                        'module' => 'projects',
                        'action' => 'update',
                        'id'=>$model->id
                    ));
                } else {
                    throw new CHttpException(404,'Project module not found');
                }
            }
        }
        $activeModule = SystemModule::model()->findByAttributes(array(
            'type' => SystemModule::TYPE_PROJECT,
            'name' => $module
        ));
        if (!$activeModule) {
            throw new CHttpException(404,'Project module not found');
        }
        $this->render('view',array(
            'model'=>$model,
            'activeModule' => $activeModule
        ));
    }

    /**
     * @param $id
     * @return Project
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model=Project::model()->findByPk($id);
        if($model===null) {
            throw new CHttpException(404,'The requested page does not exist.');
        }
        return $model;
    }
}
