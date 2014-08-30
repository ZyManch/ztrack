<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'My Web Application',

    'sourceLanguage' => 'en',
    'language' => 'ru',
    'import'=>array(
        'application.models.original.*',
        'application.models.*',
        'application.forms.*',
        'application.components.*',
        'application.controllers.*',
    ),

    // application components
    'components'=>array(
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=ztrack',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),

    ),
    'params'=>array(
        'adminEmail'=>'webmaster@example.com',
        'salt' => 'salt',
    ),
);