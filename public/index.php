<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/../protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
require_once($yii);
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../protected/extensions/bootstrap');
Yii::setPathOfAlias('photos', dirname(__FILE__).'/../photos');
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../protected/extensions/editable');
Yii::createWebApplication($config)->run();
