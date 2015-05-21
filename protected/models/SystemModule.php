<?php

/**
 * Class SystemModule
 * @property GroupProject $groupProjects
 */
class SystemModule extends CSystemModule {


    const TYPE_USER = 'user';
    const TYPE_PROJECT = 'project';
    const TYPE_WIDGET = 'widget';

    const INSTALLATION_FORCE = 'force';
    const INSTALLATION_INSTALL = 'install';
    const INSTALLATION_NOT_INSTALL = 'not_install';

    protected function instantiate($attributes)
    {
        $class = ucfirst($attributes['name']).ucfirst($attributes['type']).'Module';
        $model=new $class(null);
        return $model;
    }

    protected function _extendedRelations() {
        return array(
            'groupProjects' => array(self::MANY_MANY, 'GroupProject', 'group_project_module(system_module_id,group_project_id)','index' => 'group_id'),
        );
    }

    /**
     * @param $type
     * @param $installation
     * @return SystemModule[]
     */
    public static function getSystemModules($type,$installation) {
        if (!is_array($installation)) {
            $installation = array($installation);
        }
        $criteria = new CDbCriteria();
        $criteria->compare('type',$type);
        $criteria->addInCondition('installation',$installation);
        $criteria->index = 'id';
        $criteria->order='position ASC';
        return self::model()->findAll($criteria);
    }

    public static function getForceInstalledSystemModules($type) {
        return self::getSystemModules($type,self::INSTALLATION_FORCE);
    }

    public static function sort($items) {
        usort($items,function(SystemModule $a, SystemModule $b) {
            if ($a->position == $b->position) {
                return 0;
            }
            return ($a->position < $b->position) ? -1 : 1;
        });
        return $items;
    }

    public function checkAccess() {
        return Yii::app()->user->checkAccess($this->permission_id);
    }

}