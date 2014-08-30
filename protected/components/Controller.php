<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public function init() {
        parent::init();
        Yii::app()->bootstrap->register();
        $user = Yii::app()->user;
        $isGuest = $user->getIsGuest();
        $this->menu = array(
            array('label'=>'Главная', 'url'=>array('site/index')),
            array('label'=>'Проекты', 'visible' => !$isGuest, 'items' => $this->_getProjectTree()),
            array('label'=>'Аккаунт'.(!$isGuest ? ' ('.Yii::app()->user->name.')':''), 'items' => array(
                array('label'=>'Выход', 'url'=>array('site/logout'), 'visible'=>!$isGuest),
                array('label'=>'Войти', 'url'=>array('site/login'), 'visible'=>$isGuest),
                array('label'=>'Регистрация', 'url'=>array('site/register'), 'visible'=>$isGuest),
            ))
        );
    }

    protected function _getProjectTree() {
        if (Yii::app()->user->isGuest) {
            return array();
        }
        $user = Yii::app()->user->getUser();
        $projectIds = array();
        foreach ($user->userAccesses as $access) {
            $projectIds[] = $access->project_id;
        }
        foreach ($user->groups as $group) {
            foreach ($group->groupAccesses as $access) {
                $projectIds[] = $access->project_id;
            }
        }
        /** @var Project[] $projects */
        $projects = Project::model()->findAllByPk($projectIds);
        $list = array();
        $tree = array();
        $isFirst = true;
        while (sizeof($projects) > 0) {
            foreach ($projects as $key => $project) {
                $item = array(
                    'label' => $project->title,
                    'url' => array('project/view','id' => $project->id),
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
            $isFirst = false;
        }
        return $tree;

    }

}