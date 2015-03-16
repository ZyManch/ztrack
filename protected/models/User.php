<?php

/**
 * @property Group[] $groups
 * @property Access[] $accesses
 * @property Project[] $projects
 * @property AbstractUserModule[] $systemModules
 * @property Page[] $mainNotes
 */
class User extends CUser {

    public function checkPassword($password) {
        return $this->password == $this->_encrypt($password);
    }

    public function setPassword($password) {
        $this->password = $this->_encrypt($password);
    }

    protected function _encrypt($password) {
        if ($this->isNewRecord) {
            $this->save(false);
        }
        return md5($this->id.$password.Yii::app()->params['salt']);
    }

    protected function _extendedRelations() {
        return array(
            'accesses' => array(self::MANY_MANY,'Access','user_access(user_id,access_id)'),
            'groups' => array(self::MANY_MANY,'Group','user_group(user_id,group_id)'),
            'projects' => array(self::MANY_MANY,'Project','user_access(user_id,project_id)'),
            'systemModules' => array(self::MANY_MANY, 'SystemModule','user_system_module(user_id,system_module_id)', 'order' => 'systemModules.position ASC','index'=>'id'),
            'mainNotes' => array(self::HAS_MANY, 'Page','author_user_id', 'on' => 'mainNotes.page_type_id='.PAGE_TYPE_NOTES.' AND mainNotes.parent_page_id IS  null'),
        );
    }

    public  function getEnabledUserModules() {
        $result = $this->systemModules;
        foreach (SystemModule::getForceInstalledSystemModules(SystemModule::TYPE_USER) as $module) {
            $result[$module->id] = $module;
        }
        return SystemModule::sort($result);
    }

    public function addUserModule(SystemModule $module) {
        if($module->type != SystemModule::TYPE_USER) {
            return false;
        }
        $link = new UserSystemModule();
        $link->user_id = $this->id;
        $link->system_module_id = $module->id;
        $link->save(false);
        return true;
    }

    public function removeUserModule(SystemModule $module) {
        $link = UserSystemModule::model()->findByAttributes(array(
            'user_id'=>$this->id,
            'system_module_id' => $module->id
        ));
        if ($link && $module->type == SystemModule::TYPE_USER) {
            $link->delete();
        }
    }

    public function getGravatarUrl($size) {
        return 'http://www.gravatar.com/avatar/'.
        md5(strtolower( trim( $this->email ) ) ).
        '?s='.$size.'&d=identicon&r=g';
    }

    public function getGravatarLink($size, $options = array()) {
        return CHtml::link(
            $this->getGravatarImage($size),
            array('user/view','id'=>$this->id),
            $options
        );
    }

    public function getGravatarImage($size) {
        return CHtml::image($this->getGravatarUrl($size),CHtml::encode($this->username));
    }

    public function __toString() {
        return CHtml::link(
            CHtml::encode($this->username),
            array('user/view','id'=>$this->id)
        );
    }


}
