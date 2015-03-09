<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 12:00
 */
class WikiProjectModule extends AbstractProjectModule {

    public function getTabs() {
        return array(
            array(
                'label' => 'Wiki',
                'module' => 'wiki'
            )
        );
    }

    public function accessRules() {
        return  array_merge(
            array(
                array('allow',
                    'actions' => array('wiki'),
                    'users'=>array('*'),
                )
            ),
            parent::accessRules()
        );
    }

    public function actionWiki() {
        $request = Yii::app()->request;
        $projectId = $request->getParam('id');
        $url = $request->getParam('wiki');
        $wiki = CPage::model()->findByAttributes(array(
            'page_type_id' => PAGE_TYPE_WIKI,
            'url' => '',
            'project_id' => $projectId
        ));
        if (!$wiki) {
            $wiki = new Page();
        }
        Yii::app()->controller->renderPartial(
            '//modules/project/_wiki',
            array(
                'model' => $wiki
            )
        );
    }

}