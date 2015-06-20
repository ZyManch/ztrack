<?php

class ErrorController extends Controller
 {

    public $defaultAction = 'admin';


	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl'
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
				'actions'=>array('index','view','viewRequest'),
				'roles'=>array(PERMISSION_ERROR_VIEW),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'roles'=>array(PERMISSION_ERROR_MANAGE),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) {
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}


    public function actionViewRequest($request_id) {
        $request = Request::model()->findByPk($request_id);
        $this->render('viewRequest',array(
            'model'=>$request,
        ));
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model=new SearchError('search');
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Error the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model=Error::model()->findByPk($id);
		if($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
        }
		return $model;
	}

}
