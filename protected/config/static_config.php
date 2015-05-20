<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'My Web Application',
    'preload'=>array('loader'),
    'sourceLanguage' => 'en',
    'language' => 'ru',
    'localeClass' => 'Locale',
    'import'=>array(
        'application.models.original.*',
        'application.models.page.*',
        'application.models.search.*',
        'application.models.graph.common.*',
        'application.models.graph.*',
        'application.models.statisticColumn.*',
        'application.models.messenger.*',
        'application.models.*',
        'application.forms.*',
        'application.components.*',
        'application.components.DataFilter.*',
        'application.components.DataFormatter.*',
        'application.components.ErrorSaver.*',
        'application.controllers.*',
        'application.modules.user.*',
        'application.modules.project.*',
        'application.modules.widget.*',
        'application.models.editor.*',
        'application.behaviors.*',
        'application.widgets.*',
    ),

    // application components
    'components'=>array(
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=ztrack',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'nullConversion' => PDO::NULL_EMPTY_STRING,
            'schemaCachingDuration' => 3600 * 24,
            'enableParamLogging'    => true
        ),
        'cache'=>array(
            'class'=>'system.caching.CFileCache',
            'directoryLevel' =>1,
            'cachePath' => dirname(__FILE__).'/../../cache'
        ),
        'loader' => array(
            'class'=>'Loader',
        ),
        'authManager'=>array(
            'class' => 'AuthManager',
        ),
        'user'=>array(
            'loginUrl'=>array('user/login'),
            'allowAutoLogin'=>true,
        ),
    ),
    'params'=>array(
        'adminEmail'=>'webmaster@example.com',
        'salt' => 'salt',

    ),
);