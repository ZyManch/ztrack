<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 10:25
 */
abstract class AbstractUserModule extends SystemModule{

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

    public function render($view,$data=null,$return=false) {
        $output=$this->renderPartial($view,$data, true);
        $controller = Yii::app()->controller;
        if(($layoutFile=$controller->getLayoutFile($controller->layout))!==false)
            $output=$controller->renderFile($layoutFile,array('content'=>$output),true);

        $output=$controller->processOutput($output);

        if($return)
            return $output;
        else
            echo $output;
    }

    public function renderPartial($file,$attributes = array(), $return = false) {
        if (substr($file,0,2)!='//') {
            $file = $this->getViewPath().ltrim($file,'/');
        }
        $attributes['module'] = $this;
        return Yii::app()->controller->renderPartial($file,$attributes, $return);
    }

    public function getViewPath() {
        return 'application.modules.user.'.$this->name.'.views.';
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


    public function getMainMenuRightItems() {
        return array();
    }

    public function getMainMenuLeftItems() {
        return array();
    }

    public function getMainMenuItems() {
        return array();
    }

    public function save() {
        throw new Exception('Its read only property');
    }

    public function delete() {
        throw new Exception('Its read only property');
    }

    public function redirect($attributes =  array()) {
        Yii::app()->request->redirect(
            $this->normalizeUrl($attributes)
        );
    }

    public function normalizeUrl($attributes) {
        if (!is_array($attributes) || !isset($attributes[0]) || strpos($attributes[0],'.')) {
            return CHtml::normalizeUrl($attributes);
        }
        $action = $attributes[0];
        unset($attributes[0]);
        return CHtml::normalizeUrl(array_merge(
            array(
                'module/view',
                'module'=>$this->name,
                'action' => $action
            ),
            $attributes
        ));
    }


}