<?php

/**
 * @property Group[] $groups
 * @property Access[] $accesses
 * @property Project[] $projects
 * @property AbstractSystemModule[] $systemModules
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
            'systemModules' => array(self::MANY_MANY, 'SystemModule','user_system_module(user_id,system_module_id)', 'order' => 'systemModules.position ASC'),
        );
    }

}
