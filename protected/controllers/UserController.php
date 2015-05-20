<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 07.05.2015
 * Time: 15:24
 */
class UserController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }


    public function accessRules() {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('login'),
                'users'=>array('*'),
            ),
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('logout','index','view'),
                'users'=>array('@'),
            ),
            array(
                'allow',
                'actions' => array(
                    'addPermission','removePermission','addGroup','removeGroup',
                    'delete','create','addUserModule','removeUserModule'),
                'roles' => array(PERMISSION_USER_MANAGE)
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionCreate() {
        $model = new User;
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->company_id = Yii::app()->user->getUser()->company_id;
            $model->password = User::EMPTY_PASSWORD;
            if ($model->save()) {
                $model->invite();
                $this->redirect(array('user/view','id'=>$model->id));
            }
        }
        $this->render('create',array(
            'model'=>$model,
        ));
    }

    public function actionIndex() {
        $dataProvider=new CActiveDataProvider('User');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);
        if ($model->id == Yii::app()->user->id) {
            throw new Exception('Cant delete yourself');
        }
        if (Yii::app()->request->isPostRequest) {
            $model->delete();
            $this->redirect(array('user/index'));
        }
        $this->render('delete',array(
            'model'=>$model,
        ));
    }

    public function actionView($id) {
        $model = $this->loadModel($id);
        $permissions = Permission::model()->getTree();
        $groups = Group::model()->findAll();
        $modules = SystemModule::getSystemModules('user',array(
            SystemModule::INSTALLATION_INSTALL,
            SystemModule::INSTALLATION_NOT_INSTALL
        ));
        $this->render('view',array(
            'model'=>$model,
            'permissions' => $permissions,
            'groups' => $groups,
            'modules' => $modules
        ));
    }

    public function actionAddPermission($id) {
        $user = $this->loadModel($id);
        $permission = Permission::model()->findByPk(
            Yii::app()->request->getParam('permission_id')
        );
        if (!$permission) {
            throw new CHttpException(404,'Permission not found');
        }
        $user->addPermission($permission);
    }

    public function actionRemovePermission($id) {
        $user = $this->loadModel($id);
        $permission = Permission::model()->findByPk(
            Yii::app()->request->getParam('permission_id')
        );
        if (!$permission) {
            throw new CHttpException(404,'Permission not found');
        }
        $user->removePermission($permission);
    }

    public function actionAddGroup($id) {
        $user = $this->loadModel($id);
        $group = Group::model()->findByAttributes(array(
            'id' => Yii::app()->request->getParam('group_id'),
            'company_id' => $user->company_id
        ));
        if (!$group) {
            throw new CHttpException(404,'Group not found');
        }
        $user->addGroup($group);
    }

    public function actionRemoveGroup($id) {
        $user = $this->loadModel($id);
        $group = Group::model()->findByAttributes(array(
            'id' => Yii::app()->request->getParam('group_id'),
            'company_id' => $user->company_id
        ));
        if (!$group) {
            throw new CHttpException(404,'Group not found');
        }
        $user->removeGroup($group);
    }

    public function actionAddUserModule($id) {
        $user = $this->loadModel($id);
        $systemModule = SystemModule::model()->findByAttributes(array(
            'id' => Yii::app()->request->getParam('system_module_id'),
            'type' => 'user'
        ));
        if (!$systemModule) {
            throw new CHttpException(404,'System module not found');
        }
        $user->addUserModule($systemModule);
    }

    public function actionRemoveUserModule($id) {
        $user = $this->loadModel($id);
        $systemModule = SystemModule::model()->findByAttributes(array(
            'id' => Yii::app()->request->getParam('system_module_id'),
            'type' => 'user'
        ));
        if (!$systemModule) {
            throw new CHttpException(404,'System module not found');
        }
        $user->removeUserModule($systemModule);
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function loadModel($id) {
        $model=User::model()->findByPk($id);
        if($model===null) {
            throw new CHttpException(404,'The requested page does not exist.');
        }
        return $model;
    }
}