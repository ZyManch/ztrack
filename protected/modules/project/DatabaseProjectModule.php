<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 30.06.2015
 * Time: 10:25
 */
class DatabaseProjectModule extends AbstractProjectModule {

    function getModuleName() {
        return 'database';
    }

    public function accessRules() {
        return  array_merge(
            array(
                array('allow',
                    'actions' => array('index','manage','data','sql','structure',
                        'insert','update','delete','columnUpdate'),
                    'roles'=>array(PERMISSION_DATABASE_VIEW),
                ),
                array('allow',
                    'actions' => array('manage'),
                    'roles'=>array(PERMISSION_DATABASE_MANAGE),
                )
            ),
            parent::accessRules()
        );
    }

    public function getTabs() {
        return array(
            array(
                'label' => 'Database',
            )
        );
    }

    public function actionUpdate() {
        $row_id = Yii::app()->request->getParam('row_id');
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $row = $projectDatabase->getRow($row_id);
        $request = Yii::app()->request;
        if ($request->isPostRequest) {
            $nulls = $request->getParam('nulls',array());
            $row = $request->getParam('values',array());
            foreach ($nulls as $field => $null) {
                $row[$field] = null;
            }
            try {
                $sql = $projectDatabase->updateRow($row_id, $row);
                Yii::app()->user->setSQLFlash($sql);
                $this->redirect(array(
                    'action' => 'data',
                    'database' => $projectDatabase->getCurrentDatabase(),
                    'table' => $projectDatabase->getCurrentTable()
                ));
            } catch (CDbException $e) {
                Yii::app()->user->setErrorFlash(
                    'database',
                    'Error: :message',
                    array(':message' => nl2br(htmlspecialchars($e->getMessage())))
                );
            }

        }
        $this->renderPartial('//modules/project/database/_update',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase,
            'row' => $row
        ));
    }

    public function actionColumnUpdate() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $columns = $projectDatabase->getCurrentColumns();
        $request = Yii::app()->request;
        $columnName = $request->getParam('column');
        if (!$columnName || !isset($columns[$columnName])) {
            throw new CHttpException(404, 'Column not found');
        }
        $column = $columns[$columnName];
        $newColumns = $request->getParam('column',array());
        //var_dump($newColumns, $columnName);die();
        if ($request->isPostRequest && isset($newColumns[$columnName])) {
            $newColumn = $newColumns[$columnName];
            var_dump($newColumn);die();
        }
        $this->renderPartial('//modules/project/database/_columnUpdate',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase,
            'column' => $column
        ));
    }

    public function actionData() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $this->renderPartial('//modules/project/database/_data',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase
        ));
    }

    public function actionInsert() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $row = $projectDatabase->getBlankRow();
        $request = Yii::app()->request;
        if ($request->isPostRequest) {
            $nulls = $request->getParam('nulls',array());
            $row = $request->getParam('values',array());
            foreach ($nulls as $field => $null) {
                $row[$field] = null;
            }
            try {
                $sql = $projectDatabase->insertRow($row);
                Yii::app()->user->setSQLFlash($sql);
                $this->redirect(array(
                    'action' => 'data',
                    'database' => $projectDatabase->getCurrentDatabase(),
                    'table' => $projectDatabase->getCurrentTable()
                ));
            } catch (CDbException $e) {
                Yii::app()->user->setErrorFlash(
                    'database',
                    'Error: :message',
                    array(':message' => nl2br(htmlspecialchars($e->getMessage())))
                );
            }

        }
        $this->renderPartial('//modules/project/database/_insert',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase,
            'row' => $row
        ));
    }

    public function actionSql() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $request = Yii::app()->request;
        $rows = null;
        $sql = $request->getParam('sql',sprintf(
            'SELECT * FROM %s.%s',
            $projectDatabase->getCurrentDatabase(),
            $projectDatabase->getCurrentTable()
        ));
        if ($request->isPostRequest) {

            if ($sql) {
                try {
                    $rows = $projectDatabase->exec($sql);
                    Yii::app()->user->setSQLFlash($sql);
                } catch (CDbException $e) {
                    Yii::app()->user->setErrorFlash(
                        'database',
                        'Error: :message',
                        array(':message' => nl2br(htmlspecialchars($e->getMessage())))
                    );
                }
            }
        }
        $this->renderPartial('//modules/project/database/_sql',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase,
            'sql' => $sql,
            'rows' => $rows
        ));
    }

    public function actionStructure() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $this->renderPartial('//modules/project/database/_structure',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase,
        ));
    }

    public function actionIndex() {
        $project = $this->_getProject();
        $projectDatabase = $this->_getProjectDatabase($project);
        $this->renderPartial('//modules/project/database/_index',array(
            'project' => $project,
            'projectDatabase' => $projectDatabase,
        ));
    }

    public function actionManage() {
        $project = $this->_getProject();
        $this->renderPartial('//modules/project/database/_manage',array(
            'project' => $project
        ));
    }

    public function _getProjectDatabase(Project $project) {
        $projectDatabase = $project->projectDatabase;
        if (!$projectDatabase) {
            if (Yii::app()->user->checkAccess(PERMISSION_DATABASE_MANAGE)) {
                $this->redirect(array('action' => 'manage'));
            }
            throw new Exception('Database not configured');
        }
        $databases = $projectDatabase->getDatabases();
        $projectDatabase->connect(
            Yii::app()->request->getParam('database',reset($databases)),
            Yii::app()->request->getParam('table')
        );
        return $projectDatabase;
    }

}