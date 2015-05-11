<?php

/**
 * @property Group[] $groups
 * @property AbstractUserModule[] $systemModules
 * @property Page[] $mainNotes
 * @property Permission[] $permissions
 * @property UserPage[] $assignedUserPages
 */
class User extends CUser {

    const EMPTY_PASSWORD = 'Empty';
    const AVATAR_COUNT = 9;

    public $count;
    public $group_id;

    public function rules() {
        return array_merge(
            parent::rules(),
            array(
                array('count','safe'),
                array('group_id','numerical'),
            )
        );
    }

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
            'groups' => array(self::MANY_MANY,'Group','user_group(user_id,group_id)','index'=>'id'),
            'permissions' => array(self::MANY_MANY,'Permission','user_permission(user_id,permission_id)','index'=>'id'),
            'systemModules' => array(self::MANY_MANY, 'SystemModule','user_system_module(user_id,system_module_id)', 'order' => 'systemModules.position ASC','index'=>'id'),
            'mainNotes' => array(self::HAS_MANY, 'Page','author_user_id', 'on' => 'mainNotes.page_type_id='.PAGE_TYPE_NOTES.' AND mainNotes.parent_page_id IS  null','index'=>'id'),
            'assignedUserPages' => array(self::HAS_MANY,'UserPage','user_id','on'=>'assignedUserPages.is_assigned="Yes"')
        );
    }

    public  function getEnabledUserModules() {
        $result = $this->systemModules;
        foreach (SystemModule::getForceInstalledSystemModules(SystemModule::TYPE_USER) as $module) {
            $result[$module->id] = $module;
        }
        return SystemModule::sort($result);
    }

    public function getAvailableProjects() {
        if (!$this->groups) {
            return array();
        }
        $result = array();
        $criteria = new CDbCriteria();
        $criteria->addInCondition('t.group_id',array_keys($this->groups));
        $criteria->with = array(
            'groupProjectModules' => array()
        );
        $groupProjects = GroupProject::model()->
            findAll($criteria);
        foreach ($groupProjects as $groupProject) {
            $result[$groupProject->project_id] = array();
            foreach ($groupProject->groupProjectModules as $groupProjectModule) {
                $result[$groupProject->project_id][$groupProjectModule->system_module_id] = array(
                    //empty config
                );
            }
        }
        return $result;
    }

    public function getAvailableStatistics() {
        if (!$this->groups) {
            return array();
        }
        $result = array();
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'groupStatistics' => array('joinType' => 'INNER JOIN','select' => false)
        );
        $criteria->addInCondition('groupStatistics.group_id',array_keys($this->groups));
        $statistics = Statistic::model()->findAll($criteria);
        foreach ($statistics as $statistic) {
            $result[$statistic->id] = $statistic;
        }
        return $result;
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

    public function addPermission(Permission $permission) {
        if (!isset($this->permissions[$permission->id])) {
            $link = new UserPermission();
            $link->user_id = $this->id;
            $link->permission_id = $permission->id;
            $link->save(false);
        }
        return true;
    }

    public function removePermission(Permission $permission) {
        if ($permission->id == PERMISSION_ROOT && $this->id == Yii::app()->user->id) {
            return false;
        }
        $link = UserPermission::model()->findByAttributes(array(
            'user_id' => $this->id,
            'permission_id' => $permission->id
        ));
        if ($link) {
            $link->delete();
        }
        return true;
    }

    public function addGroup(Group $group) {
        if (!isset($this->groups[$group->id])) {
            $link = new UserGroup();
            $link->user_id = $this->id;
            $link->group_id = $group->id;
            $link->save(false);
        }
        return true;
    }

    public function removeGroup(Group $group) {
        $link = UserGroup::model()->findByAttributes(array(
            'user_id' => $this->id,
            'group_id' => $group->id
        ));
        if ($link) {
            $link->delete();
        }
        return true;
    }

    public function getGravatarUrl($size) {
        if (!Yii::app()->params['gravatar']) {
            return '/images/avatars/'.($this->id%self::AVATAR_COUNT).'.png';
        }
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
        return CHtml::image(
            $this->getGravatarUrl($size),
            CHtml::encode($this->username),
            array('width'=>$size.'px','height'=>$size.'px')
        );
    }

    public function invite() {
        if ($this->isNewRecord) {
            return false;
        }
        if ($this->password != self::EMPTY_PASSWORD) {
            return false;
        }

        return true;
    }

    public function __toString() {
        return CHtml::link(
            CHtml::encode($this->username),
            array('user/view','id'=>$this->id)
        );
    }


}
