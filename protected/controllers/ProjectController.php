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
				'actions'=>array('create','update','addGroup','removeGroup','sort',
                    'index','removeModule','updateModule','toggleGroup'),
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
        $groups = $this->_getGroups($model);
		$this->render('update',array(
			'model'=>$model,
            'modules' => $this->_getAllModules(),
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

    public function actionUpdateModule($id) {
        $project = $this->loadModel($id);
        try {
            $systemModuleId = Yii::app()->request->getParam('system_module_id');
            $systemModule = SystemModule::model()->findByAttributes(array(
                'id' => $systemModuleId,
                'type' => SystemModule::TYPE_PROJECT
            ));
            if (!$systemModule) {
                throw new Exception('System module not found');
            }
            if (!$project->haveSystemModule($systemModule)) {
                $project->addProjectModule($systemModule);
            }
            $newGroups = Yii::app()->request->getParam('groups',array());
            if (!is_array($newGroups)) {
                $newGroups = array();
            }
            $groups = $this->_getGroups($project);
            foreach ($groups as $group) {
                if ($group->groupProject) {
                    $alreadyEnabled = isset($group->groupProject->groupProjectModules[$systemModule->id]);
                    $needEnabled = in_array($group->id, $newGroups);
                    if ($alreadyEnabled && !$needEnabled) {
                        $group->groupProject->removeProjectModule($systemModule);
                    } else if ($needEnabled && !$alreadyEnabled) {
                        $group->groupProject->addProjectModule($systemModule);
                    }
                }
            }
        } catch (Exception $e) {
            Yii::app()->user->setFlash('error',$e->getMessage());
        }
        $this->redirect(array('project/update','id'=>$project->id));
    }

    public function actionRemoveModule($id) {
        $project = $this->loadModel($id);;
        try {
            $systemModuleId = Yii::app()->request->getParam('system_module_id');
            $systemModule = SystemModule::model()->findByAttributes(array(
                'id' => $systemModuleId,
                'type' => SystemModule::TYPE_PROJECT
            ));
            if (!$systemModule) {
                throw new Exception('System module not found');
            }
            $project->removeProjectModule($systemModule);
        } catch (Exception $e) {
            Yii::app()->user->setFlash('error',$e->getMessage());
        }
        $this->redirect(array('project/update','id'=>$project->id));
    }

    public function actionToggleGroup($id) {
        $project = $this->loadModel($id);;
        $groups = $this->_getGroups($project);
        $groupId = Yii::app()->request->getParam('group_id');
        if (!isset($groups[$groupId])) {
            throw new Exception('Group not found');
        }
        $group = $groups[$groupId];
        if ($group->groupProject) {
            $group->groupProject->delete();
        } else {
            $groupProject = new GroupProject();
            $groupProject->group_id = $group->id;
            $groupProject->project_id = $project->id;
            $groupProject->save(false);
        }
        $this->redirect(array('project/update','id'=>$project->id));
    }

    /**
     * @param Project $project
     * @return Group[]
     */
    protected function _getGroups(Project $project) {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'groupProject' => array('on'=>'groupProject.project_id=:project'),
            'groupProject.groupProjectModules' => array()
        );
        $criteria->params[':project'] = $project->id;
        $criteria->index = 'id';
        return Group::model()->findAll($criteria);
    }


    protected function _getAllModules() {
        return SystemModule::getSystemModules(
            SystemModule::TYPE_PROJECT,
            array(
                SystemModule::INSTALLATION_INSTALL,
                SystemModule::INSTALLATION_NOT_INSTALL,
                SystemModule::INSTALLATION_FORCE,
            )
        );
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
