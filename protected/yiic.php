<?php

// change the following paths if necessary
$yiic=dirname(__FILE__).'/../framework/yiic.php';
$config=dirname(__FILE__).'/config/console.php';
$staticConfig=dirname(__FILE__).'/config/static_config.php';
$config = require_once $config;
$staticConfig = require_once $staticConfig;
require_once dirname(__FILE__).'/merge.php';
$config = array_merge_config($staticConfig, $config);
require_once($yiic);
