<?php
/**
 * !!!!! WARNING, THIS FILE ONLY FOR IDE, CONSTANTS WILL GENERATED AUTOMATICALY !!!!
 * SET group_concat_max_len =10240;
 * SELECT GROUP_CONCAT(CONCAT('(SELECT CONCAT("define(\'",constant,"\', ",id,");\n") FROM ',TABLE_NAME,')')  SEPARATOR "\n UNION ALL \n")
 * FROM information_schema.`COLUMNS`
 * WHERE `TABLE_SCHEMA` = 'ztrack'
 * AND `COLUMN_NAME` = 'constant'
 */
define('GRAPH_CHART_LINE', 1);
define('GRAPH_NATIVE_PIE', 2);
define('GRAPH_CHART_BAR', 3);
define('GRAPH_CHART_POLAR_AREA', 4);
define('GRAPH_CHART_PIE', 5);
define('GRAPH_CHART_RADAR', 6);
define('GRAPH_FLOT_BAR', 7);
define('GRAPH_FLOT_LINE', 8);
define('GRAPH_FLOT_PIE', 10);
define('PAGE_TYPE_TICKETS', 1);
define('PAGE_TYPE_WIKI', 2);
define('PAGE_TYPE_NOTES', 3);
define('PAGE_TYPE_RELEASE', 4);
define('PAGE_TYPE_ERROR', 5);
define('PERMISSION_ROOT', 1);
define('PERMISSION_USER_MANAGE', 2);
define('PERMISSION_PROJECT_MANAGE', 3);
define('PERMISSION_GROUP_MANAGE', 4);
define('PERMISSION_PROJECT_VIEW', 5);
define('PERMISSION_TICKET_VIEW', 6);
define('PERMISSION_TICKET_MANAGE', 7);
define('PERMISSION_WIKI_VIEW', 8);
define('PERMISSION_WIKI_MANAGE', 9);
define('PERMISSION_ERROR_VIEW', 11);
define('PERMISSION_ERROR_MANAGE', 12);
define('PERMISSION_STATISTIC_VIEW', 13);
define('PERMISSION_STATISTIC_MANAGE', 14);
define('PERMISSION_DATABASE_VIEW', 15);
define('PERMISSION_DATABASE_MANAGE', 16);
