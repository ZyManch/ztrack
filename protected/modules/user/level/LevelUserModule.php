<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 10:28
 */
class LevelUserModule extends AbstractUserModule {

    public function getMainMenuItems() {
        if (Yii::app()->user->isGuest) {
            return array();
        }
        if (!Yii::app()->user->checkAccess(PERMISSION_PROJECT_MANAGE)) {
            return array();
        }
        return array(
            'settings' => array(
                'label' => 'Settings',
                'icon'=>'sitemap',
                'items' => array(
                    array(
                        'label' => 'Levels',
                        'url' => array('level/admin'),
                        'items' => array(),
                        'icon'=>'star-half-o'
                    )
                )
            )
        );
   }

}