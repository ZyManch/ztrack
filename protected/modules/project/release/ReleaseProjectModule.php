<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 18.04.2015
 * Time: 22:42
 */
class ReleaseProjectModule extends AbstractProjectModule {

    function getModuleName() {
        return 'release';
    }

    public function getTabs() {
        return array(
            array(
                'label' => 'Releases',
            )
        );
    }


    public function accessRules() {
        return  array_merge(
            array(
                array('allow',
                    'actions' => array('index','create'),
                    'users'=>array('*'),
                )
            ),
            parent::accessRules()
        );
    }

    public function actionIndex() {
        $project = $this->_getProject();
        $releases = $this->_getReleases($project);
        if (!$releases) {
            $this->redirect(array(
                'action'=>'create'
            ));
        }
        $this->renderPartial(
            '_index',
            array(
                'project' => $project,
                'releases' => $releases
            )
        );
    }

    public function actionCreate() {
        $project = $this->_getProject();
        $release= new ReleasePage();
        if (isset($_POST['ReleasePage'])) {
            $release->attributes = $_POST['ReleasePage'];
        }
        $release->author_user_id = Yii::app()->user->id;
        $release->project_id = $project->id;
        $release->page_type_id = PAGE_TYPE_RELEASE;
        if (Yii::app()->request->isPostRequest) {
            if ($release->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->renderPartial(
            '_create',
            array(
                'project' => $project,
                'release' => $release
            )
        );
    }

    protected function _getReleases(Project $project) {
        $criteria = new CDbCriteria();
        $criteria->order = 'CAST(t.title as UNSIGNED) DESC, t.title DESC';
        $criteria->compare('t.project_id',$project->id);
        $criteria->compare('t.page_type_id',PAGE_TYPE_RELEASE);
        $criteria->limit = 10;
        return ReleasePage::model()->findAll($criteria);
    }

}