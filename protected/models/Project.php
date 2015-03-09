<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 * @property AbstractProjectModule[] $systemModules
 */
class Project extends CProject {

    protected function _extendedRelations()	{
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'systemModules' => array(self::MANY_MANY, 'SystemModule', 'project_system_module(project_id,system_module_id)', 'order' => 'systemModules.position ASC'),
        );
    }
}
