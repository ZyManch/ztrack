<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 11:10
 */
class ProfileUserModule extends AbstractUserModule {

    public function getMainMenuItems() {
        return array(
            array(
                'template' => '//modules/user/_profileMain'
            ),
            array(
                'label' => 'Profile',
                'items' => array(
                    array(
                        'label' => 'Settings',
                        'url' => array('user/view','id'=>Yii::app()->user->id),
                    ),
                    array(
                        'label' => 'Logout',
                        'url' => array('user/logout'),
                    )
                ),
                'icon'=>'user'
            )
        );
    }

    public function getMainMenuRightItems() {
        return array(
            //array('template' => '//modules/user/_profileTop')
        );
    }
}