<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 20.05.2015
 * Time: 18:43
 */
class ProjectSystemModuleBehavior extends CActiveRecordBehavior {


    public function afterSave($event) {
        /** @var Project $model */
        $model = $event->sender;
        if (!$model->isNewRecord) {
            return true;
        }
        $systemModules = SystemModule::getSystemModules(
            'project',
            array(
                SystemModule::INSTALLATION_FORCE
            )
        );
        foreach ($systemModules as $systemModule) {
            $link = new ProjectSystemModule();
            $link->project_id = $model->id;
            $link->system_module_id = $systemModule->id;
            $link->save(false);
        }
        return true;
    }

}