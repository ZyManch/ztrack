<?php

if (!isset($_SERVER['argv'][1])) {
    print 'Missed domain name';
    return;
}
$domain = $_SERVER['argv'][1] ;
$secureName = preg_replace('/([^a-z0-9]+)/','_',ltrim(strtolower($domain),'w.'));
$securePath = dirname(__FILE__).'/config/domains/'.$secureName.'.json';
if (!file_exists($securePath)) {
    print 'Secure file is missed';
    return;
}
$secure = json_decode(file_get_contents($securePath),1);
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
require_once(dirname(__FILE__).'/components/ConsoleApplication.php');
if(isset($config)) {
    $app=Yii::createApplication('ConsoleApplication',$config);
    $app->commandRunner->addCommands(YII_PATH.'/cli/commands');
} else {
    $app = Yii::createApplication(
        'ConsoleApplication',
        array('basePath' => dirname(__FILE__) . '/cli')
    );
}
Yii::setPathOfAlias('vendor', dirname(__FILE__).'/../vendor');
$env=@getenv('YII_CONSOLE_COMMANDS');
if(!empty($env))
    $app->commandRunner->addCommands($env);

$app->run();
