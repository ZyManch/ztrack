<?php

$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/../protected/config/main.php';
$staticConfig=dirname(__FILE__).'/../protected/config/static_config.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
require_once($yii);
$config = require_once $config;
$staticConfig = require_once $staticConfig;
require_once dirname(__FILE__).'/../protected/merge.php';
$mergedConfig = array_merge_config($staticConfig, $config);
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../protected/extensions/bootstrap');
Yii::setPathOfAlias('editable', dirname(__FILE__).'/../protected/extensions/editable');
Yii::createWebApplication($mergedConfig)->run();
