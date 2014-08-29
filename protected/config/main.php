<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	// preloading 'log' component
	'preload'=>array('log'),
    'sourceLanguage' => 'en',
    'language' => 'ru',
	// autoloading model and component classes
	'import'=>array(
		'application.models.original.*',
		'application.models.good.*',
		'application.models.cart_has_good.*',
		'application.models.*',
		'application.forms.*',
		'application.components.*',
		'application.controllers.*',
        'editable.*'
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'080388',
            'generatorPaths'=>array(
                'bootstrap.gii',
            ),
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
            'class'=>'WebUser',
			'allowAutoLogin'=>true,
		),
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
        'editable' => array(
            'class'     => 'editable.EditableConfig',
            'form'      => 'bootstrap',        //form style: 'bootstrap', 'jqueryui', 'plain'
            'mode'      => 'popup',            //mode: 'popup' or 'inline'
            'defaults'  => array(              //default settings for all editable elements
                'emptytext' => 'Click to edit'
            )
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
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=ztrack',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
        'robokassa' => array(
            'class' => 'ext.robokassa.Robokassa',
            'sMerchantLogin' => 'login',
            'sMerchantPass1' => 'pass1',
            'sMerchantPass2' => 'pass2',
            'sCulture' => 'ru',
            'sIncCurrLabel' => '',
            'orderModel' => 'Invoice', // ваша модель для выставления счетов
            'priceField' => 'amount', // атрибут модели, где хранится сумма
            'server' => 'our', // тестовый либо боевой режим работы
        ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
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
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
        'salt' => 'salt',
        'price' => 2.00,
        'min_count' => 50
	),
);