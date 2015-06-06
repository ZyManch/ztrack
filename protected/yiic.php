<?php

$yii=dirname(__FILE__).'/../vendor/yiisoft/yii/framework/yii.php';
$config=dirname(__FILE__).'/config/console.php';
$staticConfig=dirname(__FILE__).'/config/static_config.php';
$config = require_once $config;
$staticConfig = require_once $staticConfig;
require_once dirname(__FILE__).'/merge.php';
$config = array_merge_config($staticConfig, $config);
defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));

defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);

if(isset($config))
{
    $app=Yii::createConsoleApplication($config);
    $app->commandRunner->addCommands(YII_PATH.'/cli/commands');
}
else
    $app=Yii::createConsoleApplication(array('basePath'=>dirname(__FILE__).'/cli'));
Yii::setPathOfAlias('vendor', dirname(__FILE__).'/../vendor');
$env=@getenv('YII_CONSOLE_COMMANDS');
if(!empty($env))
    $app->commandRunner->addCommands($env);

$app->run();
