<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 11:58
 */
abstract class AbstractProjectModule extends SystemModule {

    public $defaultAction = 'index';

    abstract function getModuleName();

    public function beforeInstall(Project $project) {

    }

    public function beforeRemove(Project $project) {

    }

    public function beforeAddAccess(GroupProject $groupProject) {

    }

    public function beforeRemoveAccess(GroupProject $groupProject) {

    }

    public function getTabs() {
        return array();
    }

    public function accessRules() {
        return array(
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function runAction() {
        print 123;
    }

    public function run($action) {
        $method = 'action'.ucfirst($action);
        $this->$method();
    }

    public function hasAccess($action) {
        $app=Yii::app();
        $request=$app->getRequest();
        $user=$app->getUser();
        $verb=$request->getRequestType();
        $ip=$request->getUserHostAddress();
        $objectAction = new CInlineAction($this,$action);
        foreach($this->getRules() as $rule) {
            if(($allow=$rule->isUserAllowed($user,$this,$objectAction,$ip,$verb))>0) {
                break;
            } elseif($allow<0) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return CAccessRule[]
     */
    public function getRules() {
        $rules = array();
        foreach($this->accessRules() as $rule) {
            if(is_array($rule) && isset($rule[0])) {
                $r=new CAccessRule;
                $r->allow=$rule[0]==='allow';
                foreach(array_slice($rule,1) as $name=>$value) {
                    if($name==='expression' || $name==='roles' || $name==='message' || $name==='deniedCallback') {
                        $r->$name = $value;
                    } else {
                        $r->$name = array_map('strtolower', $value);
                    }
                }
                $rules[]=$r;
            }
        }
        return $rules;
    }

    public function renderPartial($file,$attributes = array()) {
        if (substr($file,0,2)!='//') {
            $file = '//modules/project/'.$this->name.'/'.ltrim($file,'/');
        }
        Yii::app()->controller->renderPartial($file,$attributes);
    }

    public function redirect($attributes =  array()) {
        Yii::app()->request->redirect(
            $this->normalizeUrl($attributes)
        );
    }

    public function normalizeUrl($attributes) {
        return CHtml::normalizeUrl(array_merge(
            array(
                'project/view',
                'id' => Yii::app()->request->getParam('id'),
                'module'=>$this->name,
            ),
            $attributes
        ));
    }

    /**
     * @return Project
     */
    protected function _getProject() {
        $projectId = Yii::app()->request->getParam('id');
        return Project::model()->findByPk($projectId);
    }

}