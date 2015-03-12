<?php

class NotesController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','admin','delete'),
				'users'=>array('@'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id = null) {
		$model=new Page;
        $parent = null;
        $topPage = null;
        if ($id) {
            $parent = $this->loadModel($id);
            $topPage = $parent->getTopPage();
        }
		if(isset($_POST['Page'])) {
			$model->attributes=$_POST['Page'];
            $model->parent_page_id = ($parent ? $parent->id : null);
			if($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
            'top_id' => $topPage ? $topPage->id: null
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model=$this->loadModel($id);

		if(isset($_POST['Page'])) {
			$model->attributes=$_POST['Page'];
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
        $model = $this->loadModel($id);
        $parent = $model->getTopPage();
        $parentId = $parent->id != $model->id ? $parent->id : null;
        if (Yii::app()->request->isPostRequest) {
            $model->delete();
            $this->redirect(array('notes/index','id'=>$parentId));
        }

		$this->render('delete',array('model'=>$model,'parentId'=>$parentId));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id = null) {
        $notes = Yii::app()->user->getUser()->mainNotes;
        if (!$notes) {
            $this->redirect(array('notes/create'));
        }
        if (!$id) {
            $id = $notes[0]->id;
        }
		$this->render('index',array(
            'id' => $id,
			'notes'=>$notes,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($id = null) {
        $notes = Yii::app()->user->getUser()->mainNotes;
        if (!$notes) {
            $this->redirect(array('notes/create'));
        }
        if (!$id) {
            $id = $notes[0]->id;
        }
		$this->render('admin',array(
            'id' => $id,
            'notes' => $notes,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Page the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id) {
		$model=Page::model()->findByPk($id);
		if($model===null) {
			throw new CHttpException(404,'The requested page does not exist.');
        }
		return $model;
	}

}
