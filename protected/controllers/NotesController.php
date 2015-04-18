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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update','sort','delete'),
				'users'=>array('@'),
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
	public function actionCreate($id = null) {
		$model=new NotePage();
        $parent = null;
        $topPage = null;
        if ($id) {
            $parent = $this->loadModel($id);
            $topPage = $parent->getTopPage();
        }
		if(isset($_POST['NotePage'])) {
			$model->attributes=$_POST['NotePage'];
            $model->parent_page_id = ($parent ? $parent->id : null);
            $model->page_type_id = PAGE_TYPE_NOTES;
            $model->author_user_id = Yii::app()->user->id;
			if($model->save()) {
                $this->redirect(array('index','id'=>$model->getTopPage()->id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
            'top_id' => $topPage ? $topPage->id: null
		));
	}

    public function actionSort($id) {
        $notes = Yii::app()->user->getUser()->mainNotes;
        if (!$notes) {
            $this->redirect(array('notes/create'));
        }
        if (!$id) {
            $noteIds = array_keys($notes);
            $id = $noteIds[0];
        }
        if (!isset($notes[$id])) {
            throw new Exception('Note not found');
        }
        $mainNote = $notes[$id];
        $mainNote->sort(
            Yii::app()->request->getParam('notes')
        );
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model=$this->loadModel($id);

		if(isset($_POST['NotePage'])) {
			$model->attributes=$_POST['NotePage'];
			if($model->save()) {
				$this->redirect(array('index','id'=>$model->getTopPage()->id));
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
            $noteIds = array_keys($notes);
            $id = $noteIds[0];
        }
        if (!isset($notes[$id])) {
            throw new Exception('Note not found');
        }
		$this->render('index',array(
            'id' => $id,
			'notes'=>$notes,
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
        if ($model->author_user_id != Yii::app()->user->id) {
            throw new CHttpException(404,'The requested page does not exist.');
        }
        if ($model->page_type_id != PAGE_TYPE_NOTES) {
            throw new CHttpException(404,'The requested page does not exist.');
        }
		return $model;
	}

}
