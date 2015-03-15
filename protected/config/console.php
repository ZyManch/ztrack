<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'components'=>array(
        'constants' => array(
            'enabled'=>false,
        ),
    ),
    'commandMap' => array(
        'migrate' => array(
            'modulePaths' => array(
                'class' => 'application.vendor.yiiext.migrate-commands.EMigrateCommand',
                'migrationTable' => 'migration',
                'applicationModuleName' => 'core',
                'migrationPath' => 'application.migrations',
            ),
        )
    ),
    'params' => array(
        /*
        'composer.callbacks' => array(
            'yiisoft/yii-install' => array('yiic', 'webapp', dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'),
            'post-update' => array('yiic', 'migrate'),
            'post-install' => array('yiic', 'migrate'),
        ),
        /**/
    )
);