<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 10:27
 */
class DashboardController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {

        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('index', 'create','update','createWidget','createWidget2',
                    'cancel','configure','deleteWidget'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex($id = null) {
        $dashboards = Dashboard::model()->getForUser(
            Yii::app()->user->id
        );
        if (!$id || !isset($dashboards[$id])) {
            $ids = array_keys($dashboards);
            $id = $ids[0];
        }
        $this->render('index',array(
            'id' => $id,
            'dashboards' => $dashboards
        ));
    }

    public function  actionConfigure($id,$dashboard_system_module_id) {
        $dashboard = self::loadModel($id);
        $dashboardSystemModules = $dashboard->getRelated('dashboardSystemModules',true,array('index'=>'id'));
        if (!isset($dashboardSystemModules[$dashboard_system_module_id])) {
            throw new Exception('Link not found');
        }
        /** @var DashboardSystemModule $dashboardSystemModule */
        $dashboardSystemModule = $dashboardSystemModules[$dashboard_system_module_id];
        if (Yii::app()->request->isPostRequest) {
            $config = $dashboardSystemModule->systemModule->convertPostToConfigure(
                Yii::app()->request->getParam('config',array())
            );
            $newParams = Yii::app()->request->getParam('widget');
            $dashboardSystemModule->attributes = $newParams;
            $dashboardSystemModule->params = json_encode($config);
            if ($dashboardSystemModule->render() && $dashboardSystemModule->save()) {
                $this->redirect(array('dashboard/cancel','id'=>$dashboard->id));
            } else {
                Yii::app()->user->setFlash('error','Error save config: '.$dashboardSystemModule->getErrorsAsText());
            }
        }
        $this->render('configure',array(
            'dashboardSystemModule' => $dashboardSystemModule,
        ));
    }

    public function actionCreate() {
        $model=new Dashboard;

        if(isset($_POST['Dashboard'])) {
            $model->attributes=$_POST['Dashboard'];
            $lastDashboard = Dashboard::model()->find(array(
                'order'=>'position DESC',
                'limit' => 1
            ));
            $model->user_id = Yii::app()->user->id;
            $model->position = ($lastDashboard ? $lastDashboard->position+1 : 1);
            if($model->save()) {
                $this->redirect(array('index','id'=>$model->id));
            }
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    public function actionUpdate($id) {
        $model=self::loadModel($id);

        if(isset($_POST['Dashboard'])) {
            $model->attributes=$_POST['Dashboard'];
            if($model->save()) {
                $this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        self::loadModel($id)->delete();

        if(!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    public function actionDeleteWidget($id, $dashboard_system_module_id) {
        $dashboard = self::loadModel($id);
        $dashboardSystemModules = $dashboard->getRelated('dashboardSystemModules',true,array('index'=>'id'));
        if (!isset($dashboardSystemModules[$dashboard_system_module_id])) {
            throw new Exception('Link not found');
        }
        /** @var DashboardSystemModule $dashboardSystemModule */
        $dashboardSystemModule = $dashboardSystemModules[$dashboard_system_module_id];
        $dashboardSystemModule->delete();
        Yii::app()->user->setFlash('success',$dashboardSystemModule->title);
        $this->redirect(array('dashboard/cancel','id'=>$id));
    }

    public function actionCreateWidget($id) {
        $dashboard = self::loadModel($id);
        $modules = SystemModule::model()->findAll(array(
            'condition' => 'type=:type',
            'params' => array(':type' => SystemModule::TYPE_WIDGET),
            'order' => 'position ASC'
        ));
        $this->render('createWidget',array(
            'dashboard' => $dashboard,
            'modules' => $modules
        ));
    }


    public function actionCreateWidget2($id, $system_module_id = null) {
        $dashboard = self::loadModel($id);
        /** @var AbstractWidgetModule $systemModule */
        $systemModule = SystemModule::model()->findByPk($system_module_id);

        if (!$systemModule || $systemModule->type != SystemModule::TYPE_WIDGET || !$systemModule->checkAccess()) {
            throw new CHttpException(404,'Widget not found');
        }
        $link = new DashboardSystemModule();
        $link->attributes = array(
            'type' => 'Default',
            'title' => $systemModule->getTitle(),
            'rows' => 4,
        );
        $link->attributes = Yii::app()->request->getParam('widget',array());
        if (Yii::app()->request->isPostRequest) {

            $configure = $systemModule->convertPostToConfigure(
                Yii::app()->request->getParam('config',array())
            );
            if ($configure !== false) {
                $link->attributes = array(
                    'dashboard_id' => $dashboard->id,
                    'system_module_id' => $systemModule->id,
                    'position' => $dashboard->getMaxPosition()+1,
                    'params' => json_encode($configure)
                );
                if (!$link->save()) {
                    Yii::app()->user->setFlash(
                        'error',
                        'Error save widget to dashboard: '.$link->getErrorsAsText()
                    );
                } else {
                    $this->redirect(array('dashboard/index','id'=>$dashboard->id));
                }
            }

        }
        $this->render('createWidget2',array(
            'dashboard' => $dashboard,
            'systemModule' => $systemModule,
            'dashboardSystemModule' => $link
        ));
    }

    public function actionCancel($id) {
        $dashboard = self::loadModel($id);
        if ($dashboard->project_id) {
            $this->redirect(array(
                'project/view',
                'id' => $dashboard->project_id
            ));
        } else {
            $this->redirect(array(
                'dashboard/index',
                'id'=>$dashboard->id
            ));
        }
    }

    public function actionSwap($id) {
        $model = self::loadModel($id);
        $fromId = Yii::app()->request->getParam('from');
        $toId = Yii::app()->request->getParam('to');
        $modules = $model->dashboardSystemModules;
        if (!isset($modules[$fromId])) {
            throw new Exception('Widget not found:'.$fromId);
        }
        if (!isset($modules[$toId])) {
            throw new Exception('Widget not found:'.$fromId);
        }

        $oldPosition = $modules[$fromId]->position;
        $modules[$fromId]->position = $modules[$toId]->position;
        $modules[$toId]->position = $oldPosition;
        $modules[$fromId]->save();
        $modules[$toId]->save();

    }
    /**
     * @param $id
     * @return Dashboard
     * @throws Exception
     */
    public static function loadModel($id) {
        $dashboards = Dashboard::model()->getForUser(
            Yii::app()->user->id
        );
        if (!isset($dashboards[$id])) {
            throw new Exception('Dashboard not found');
        }
        /** @var Dashboard[] $dashboards */
        return $dashboards[$id];
    }



}