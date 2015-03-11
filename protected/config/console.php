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
                'user' => 'application.vendor.mishamx.yii-user.migrations',
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