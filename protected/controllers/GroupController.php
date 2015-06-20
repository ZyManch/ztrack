<?php

class GroupController extends Controller  {


	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'roles'=>array(PERMISSION_GROUP_MANAGE),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'roles'=>array(PERMISSION_GROUP_MANAGE),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model=new Group;

		if(isset($_POST['Group'])) {
			$model->attributes=$_POST['Group'];
            $model->company_id = Yii::app()->user->getUser()->company_id;
            $users = Yii::app()->request->getParam('users',array());
			if($model->save() && $model->updateUsers($users)) {
                Yii::app()->user->setSuccessFlash(
                    'group',
                    'Group ":group" created',
                    array(':group' => CHtml::encode($model->title))
                );
				$this->redirect(array('admin'));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model=$this->loadModel($id);

		if(isset($_POST['Group'])) {
			$model->attributes=$_POST['Group'];
            $model->company_id = Yii::app()->user->getUser()->company_id;
            $users = Yii::app()->request->getParam('users',array());
			if($model->save() && $model->updateUsers($users)) {
                Yii::app()->user->setSuccessFlash(
                    'group',
                    'Group ":group" saved',
                    array(':group' => CHtml::encode($model->title))
                );
				$this->redirect(array('admin'));
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
		$this->loadModel($id)->delete();

		if(!isset($_GET['ajax'])) {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model=new SearchGroup('search');
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Group the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model=Group::model()->findByPk($id);
		if($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
        }
        if ($model->company_id != Yii::app()->user->getUser()->company_id) {
            throw new CHttpException(404,'The requested page does not exist.');
        }
		return $model;
	}

}
