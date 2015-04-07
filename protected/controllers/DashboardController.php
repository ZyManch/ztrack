<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 10:27
 */
class DashboardController extends Controller {

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
        $dashboards = Dashboard::model()->getForUser(
            Yii::app()->user->id
        );
        if (!isset($dashboards[$id])) {
            throw new Exception('Dashboard not found');
        }
        /** @var Dashboard $dashboard */
        $dashboard = $dashboards[$id];
        $dashboardSystemModules = $dashboard->getRelated('dashboardSystemModules',true,array('index'=>'id'));
        if (!isset($dashboardSystemModules[$dashboard_system_module_id])) {
            throw new Exception('Link not found');
        }
        /** @var DashboardSystemModule $dashboardSystemModule */
        $dashboardSystemModule = $dashboardSystemModules[$dashboard_system_module_id];
        if ($dashboard->project_id) {
            $backUrl = array();
        } else {
            $backUrl = array(
                'dashboard/index',
                'id'=>$dashboard->id
            );
        }
        if (Yii::app()->request->isPostRequest) {
            $config = Yii::app()->request->getParam('config');
            $dashboardSystemModule->params = json_encode($config);
            if ($dashboardSystemModule->render() && $dashboardSystemModule->save()) {
                $this->redirect($backUrl);
            } else {
                Yii::app()->user->setFlash('error','Error save config: '.$dashboardSystemModule->getErrorsAsText());
            }
        }
        $this->render('configure',array(
            'dashboardSystemModule' => $dashboardSystemModule,
            'backUrl'=>$backUrl
        ));
    }

    public function actionCreateWidget($id) {

    }

    public static function loadModel() {

    }

}