<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.04.2015
 * Time: 15:52
 */
class ErrorsProjectModule extends AbstractProjectModule {

    function getModuleName() {
        return 'errors';
    }

    public function beforeInstall(Project $project) {
        $tokens = $project->tokens;
        if (!$tokens) {
            $token = new Token();
            $token->project_id = $project->id;
            $token->type = Token::TYPE_PRIVATE;
            $token->setRandomToken();
            $token->save(false);
        }
    }

    public function getTabs() {
        return array(
            array(
                'label' => 'Errors',
            )
        );
    }

    public function accessRules() {
        return  array_merge(
            array(
                array('allow',
                    'actions' => array('index'),
                    'users'=>array('*'),
                )
            ),
            parent::accessRules()
        );
    }

    public function actionIndex() {
        $project = $this->_getProject();
        $search = new SearchError('search');
        $search->project_id = $project->id;
        $this->renderPartial(
            '_view',
            array(
                'project' => $project,
                'model' => $search
            )
        );

    }
}