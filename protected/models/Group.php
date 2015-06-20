<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 30.08.14
 * Time: 7:36
 * @property GroupProject $groupProject
 * @property User[] $users
 */
class Group extends CGroup {

    const TYPE_NORMAL = 'Normal';
    const TYPE_HIDDEN = 'Hidden';

    protected function _extendedRelations() {
        return array(
            'groupProject' => array(self::HAS_ONE, 'GroupProject', 'group_id'),
            'groupProjects' => array(self::HAS_MANY, 'GroupProject', 'group_id','index'=>'project_id'),
            'users' => array(self::MANY_MANY, 'User', 'user_group(group_id,user_id)','index'=>'id'),
        );
    }

    public function updateUsers($userIds) {
        if (!$userIds) {
            $userIds = array();
        }
        $oldUsersIds = array_keys($this->users);
        foreach ($this->users as $user) {
            if (!in_array($user->id,$userIds)) {
                $user->removeGroup($this);
            }
        }
        $newUsersIds = array_diff($userIds, $oldUsersIds);
        $users = User::model()->findAllByPk($newUsersIds);
        foreach ($users as $user) {
            $user->addGroup($this);
        }
        return true;
    }

    public function hasProjectSystemModule(Project $project, SystemModule $module) {

    }
}