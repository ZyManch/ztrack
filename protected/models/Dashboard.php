<?php

/**
* This is the model class for table "dashboard".
*
* The followings are the available columns in table 'dashboard':
*/
class Dashboard extends CDashboard {


    public function _extendedRelations() {
        return array(
            'dashboardSystemModules' => array(self::HAS_MANY, 'DashboardSystemModule', 'dashboard_id','order'=>'dashboardSystemModules.position ASC','index'=>'id')
        );
    }

    public function getForUser($userId, $projectId = null) {
        $criteria = new CDbCriteria();
        $criteria->addCondition('(t.user_id IS NULL OR t.user_id=:user)');
        if ($projectId) {
            $criteria->compare('t.project_id', $projectId);
        } else {
            $criteria->addCondition('t.project_id IS NULL');
        }
        $criteria->index = 'id';
        $criteria->params[':user'] = $userId;
        $criteria->order = 't.position ASC';
        return Dashboard::model()->findAll($criteria);
    }

    public function getMaxPosition() {
        $position = 0;
        foreach ($this->dashboardSystemModules as $systemModule) {
            if ($position < $systemModule->position) {
                $position = $systemModule->position;
            }
        }
        return $position;
    }
}
