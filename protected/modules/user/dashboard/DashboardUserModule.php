<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 10:25
 */
class DashboardUserModule extends AbstractUserModule {

    public function getMainMenuItems() {
        return array(
            array(
                'label' => 'Dashboard',
                'url' => array('dashboard/index'),
                'icon'=>'area-chart'
            )
        );
    }
}