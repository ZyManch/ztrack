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

}