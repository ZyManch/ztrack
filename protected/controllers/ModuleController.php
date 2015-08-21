<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 21.08.2015
 * Time: 16:07
 */
class ModuleController extends Controller
{


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
            array('allow',
                'actions'=>array('view'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionView($module, $action = null) {
        if (!$action) {
            $action = 'admin';
        }
        foreach (Yii::app()->user->getSystemModules() as $systemModule) {
            if ($systemModule->name == $module) {
                if (!$systemModule->checkAccess()) {
                    throw new CHttpException(404,'Page not found');
                }
                $systemModule->run($action);
            }
        }
    }
}
