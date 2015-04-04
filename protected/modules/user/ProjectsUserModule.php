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
        $user = Yii::app()->user->getUser();
        $projectIds = array();
        foreach ($user->groups as $group) {
            foreach ($group->groupProjects as $access) {
                $projectIds[] = $access->project_id;
            }
        }
        /** @var Project[] $projects */
        $projects = Project::model()->findAllByPk($projectIds);
        $list = array();
        $tree = array();
        $previousSize = 0 ;
        while (sizeof($projects) > 0 && $previousSize !=sizeof($projects)) {
            $previousSize = sizeof($projects);
            foreach ($projects as $key => $project) {
                $item = array(
                    'label' => $project->title,
                    'url' => array('project/view','id'=>$project->id),
                    'items' => array()
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