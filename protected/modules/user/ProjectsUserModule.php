<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 10:28
 */
class ProjectsUserModule extends AbstractUserModule {

    public function getMainMenuItems() {
        if (Yii::app()->user->isGuest) {
            return array();
        }
        /** @var User $user */
        $user = Yii::app()->user->getUser();
        $projectIds = array_keys($user->getAvailableProjects());
        /** @var Project[] $projects */
        $projects = Project::model()->findAllByPk($projectIds);
        $list = array();
        $tree = array();
        if (Yii::app()->user->checkAccess(PERMISSION_PROJECT_MANAGE)) {
            $tree[] = array(
                'label' => 'Projects',
                'url' => array('project/admin'),
                'items' => array(),
                'icon'=>'cubes'
            );
        }
        $previousSize = 0 ;
        while (sizeof($projects) > 0 && $previousSize !=sizeof($projects)) {
            $previousSize = sizeof($projects);
            foreach ($projects as $key => $project) {
                $item = array(
                    'label' => $project->title,
                    'url' => array('project/view','id'=>$project->id),
                    'items' => array(),
                    'icon'=>'folder'
                );
                $list[$project->id] = &$item;
                if (!$project->parent_id) {
                    $tree[] = &$item;
                    unset($projects[$key]);
                } else if (isset($list[$project->parent_id])) {
                    $list[$project->parent_id]['items'][] = &$item;
                    unset($projects[$key]);
                }
                unset($item);
            }
        }
        return $tree;
    }

}