<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 30.08.14
 * Time: 7:36
 * @property GroupProject $groupProject
 */
class Group extends CGroup {

    protected function _extendedRelations() {
        return array(
            'groupProject' => array(self::HAS_ONE, 'GroupProject', 'group_id'),
        );
    }
}