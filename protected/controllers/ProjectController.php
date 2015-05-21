<?php

class ProjectController extends Controller
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
				'actions'=>array('view'),
				'roles'=>array(PERMISSION_PROJECT_VIEW),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','addGroup','removeGroup','sort'),
				'roles'=>array(PERMISSION_PROJECT_MANAGE),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'roles'=>array(PERMISSION_PROJECT_MANAGE),
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

    public function actionSort() {
        Project::sort(
            Yii::app()->request->getParam('projects')
        );
    }

    public function actionRemoveGroup($id) {
        $model = $this->loadModel($id);
        $user = Yii::app()->user->getUser();
        $group = Group::model()->findByAttributes(array(
            'id' => Yii::app()->request->getParam('group_id'),
            'company_id' => $user->company_id
        ));
        if (!$group) {
            throw new CHttpException(404,'Group not found');
        }
        $model->removeGroup($group);
    }

    public function actionAddGroup($id) {
        $model = $this->loadModel($id);
        $user = Yii::app()->user->getUser();
        $group = Group::model()->findByAttributes(array(
            'id' => Yii::app()->request->getParam('group_id'),
            'company_id' => $user->company_id
        ));
        if (!$group) {
            throw new CHttpException(404,'Group not found');
        }
        $model->addGroup($group);
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id = null) {
		$model=new Project;
        if ($id) {
            $model->parent_id = $id;
        }
		if(isset($_POST['Project'])) {
			$model->attributes=$_POST['Project'];
            $model->company_id = Yii::app()->user->getUser()->company_id;
			if($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Project'])) {
			$model->attributes=$_POST['Project'];
			if($model->save()) {
				$this->redirect(array('view','id'=>$model->id));
            }
		}
        $groups = Group::getVariants();
		$this->render('update',array(
			'model'=>$model,
            'groups' => $groups
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
        $projects = Project::getAllProjectsAsTree();
        //var_dump($projects);die();
		$this->render('admin',array(
			'projects'=>$projects,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Project the loaded model
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
