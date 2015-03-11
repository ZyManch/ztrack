<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'preload'=>array('log'),
	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'080388',
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),
    'import'=>array(

    ),
	// application components
	'components'=>array(
		'user'=>array(
            'class'=>'WebUser',
			'allowAutoLogin'=>true,
		),

        'themeManager'=>array(
            'class'=>'CThemeManager',
        ),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
            'caseSensitive'=>false,
            'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
        'log' => array(
            'class' => 'CLogRouter',
            'routes'=> array(
                array(
                    'class'  => 'ext.yiidebugtb.XWebDebugRouter',
                    'config' => 'alignRight, opaque, runInDebug, fixedPos, yamlStyle',
                    'levels' => 'error, warning, trace, profile, info',
                    'allowedIPs' => array('127.0.0.1', $_SERVER['REMOTE_ADDR']),
                ),
            ),
        ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
	),
	'params'=>array(

	),
);