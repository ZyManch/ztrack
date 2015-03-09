<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 12:00
 */
class WikiProjectModule extends AbstractProjectModule {

    public $defaultAction = 'view';

    public function getModuleName() {
        return 'wiki';
    }

    public function getTabs() {
        return array(
            array(
                'label' => 'Wiki',
            )
        );
    }

    public function accessRules() {
        return  array_merge(
            array(
                array('allow',
                    'actions' => array('view','update'),
                    'users'=>array('*'),
                )
            ),
            parent::accessRules()
        );
    }

    public function actionView() {
        $wiki = $this->_getCurrentWiki();
        Yii::app()->controller->renderPartial(
            '//modules/project/wiki/_view',
            array(
                'model' => $wiki
            )
        );
    }

    public function actionUpdate() {
        $wiki = $this->_getCurrentWiki();
        $request = Yii::app()->request;
        $projectId = $request->getParam('id');
        $url = $request->getParam('wiki','');
        if (isset($_POST['Page']) && is_array($_POST['Page'])) {
            $wiki->attributes = $_POST['Page'];
            $wiki->attributes = array(
                'page_type_id' => PAGE_TYPE_WIKI,
                'changed' => time(),
                'url' => $url,
                'project_id' => $projectId
            );
            if (!$wiki->author_user_id) {
                $wiki->author_user_id = Yii::app()->user->id;
            }
            if (!$wiki->save()) {
                Yii::app()->user->setFlash('error',$wiki->getErrorsAsText());
            }
        }
        Yii::app()->controller->renderPartial(
            '//modules/project/wiki/_update',
            array(
                'model' => $wiki
            )
        );
    }

    protected function _getCurrentWiki() {
        $request = Yii::app()->request;
        $projectId = $request->getParam('id');
        $url = $request->getParam('wiki','');
        $wiki = CPage::model()->findByAttributes(array(
            'page_type_id' => PAGE_TYPE_WIKI,
            'url' => $url,
            'project_id' => $projectId
        ));
        if (!$wiki) {
            $wiki = new Page();
        }
        return $wiki;
    }

}