<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 10:25
 */
class GroupsUserModule extends AbstractUserModule {

    public function getMainMenuItems() {
        return array(
            'settings' => array(
                'label' => 'Settings',
                'icon'=>'sitemap',
                'items' => array(
                    array(
                        'label' => 'Groups',
                        'url' => array('group/admin'),
                        'icon'=>'users'
                    )
                )
            )
        );
    }
}