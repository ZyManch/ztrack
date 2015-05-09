<?php

class m150316_110848_init extends EDbMigration
{
	public function up() {
        $this->createTable('access',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'company_id' => 'int(10) unsigned DEFAULT NULL',
            'title' => 'varchar(32) NOT NULL',
            'access' => 'set("read","create","update","exception") NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `company_id` (`company_id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3');

        $this->createTable('branch',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'title' => 'varchar(32) NOT NULL',
            'company_id' => 'int(10) unsigned DEFAULT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `company_id` (`company_id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2');

        $this->createTable('browser',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'browser' => 'varchar(255) NOT NULL',
            'name' => 'varchar(32) NOT NULL DEFAULT "unknown"',
            'version' => 'varchar(32) NOT NULL DEFAULT "unknown"',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');


        $this->createTable('company',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'title' => 'varchar(64) NOT NULL',
            'editor_id' => 'int(10) unsigned NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `editor_id` (`editor_id`)'
        ), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2');

        $this->createTable('editor',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'name' => 'varchar(32) NOT NULL',
            'title' => 'varchar(32) NOT NULL',
            'description' => 'text NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3');

        $this->createTable('exception',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'title' => 'int(11) NOT NULL',
            'level_id' => 'int(10) unsigned NOT NULL',
            'total_count' => 'int(10) unsigned NOT NULL DEFAULT "0"',
            'trace_file' => 'varchar(200) DEFAULT NULL',
            'trace_line' => 'mediumint(8) unsigned DEFAULT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `level_id` (`level_id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

        $this->createTable('group',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'company_id' => 'int(10) unsigned NOT NULL',
            'title' => 'varchar(32) NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `company_id` (`company_id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2');


        $this->createTable('group_access',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'group_id' => 'int(10) unsigned NOT NULL',
            'access_id' => 'int(10) unsigned NOT NULL',
            'project_id' => 'int(10) unsigned NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `user_id` (`group_id`)',
            'KEY `access_id` (`access_id`)',
            'KEY `project_id` (`project_id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2');

        $this->createTable('guest_system_module',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'system_module_id' => 'int(10) unsigned NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `system_module_id` (`system_module_id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');


        $this->createTable('label',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'company_id' => 'int(10) unsigned NOT NULL',
            'title' => 'varchar(32) NOT NULL',
            'color' => 'char(6) NOT NULL DEFAULT "1ab394"',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `company_id` (`company_id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2');


        $this->createTable('level',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'type' => 'enum("Page","Exception") NOT NULL DEFAULT "Exception"',
            'title' => 'varchar(32) NOT NULL',
            'css_class' => 'varchar(32) NOT NULL DEFAULT ""',
          'company_id' => 'int(10) unsigned DEFAULT NULL',
          'weight' => 'mediumint(8) unsigned NOT NULL',
          'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
          'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
          'PRIMARY KEY (`id`)',
          'KEY `company_id` (`company_id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10');


        $this->createTable('method',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'title' => 'varchar(32) NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

        $this->createTable('os',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'os' => 'varchar(255) NOT NULL',
            'name' => 'varchar(32) NOT NULL DEFAULT "unknown"',
            'version' => 'varchar(32) NOT NULL DEFAULT "unknown"',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

        $this->createTable('page',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'parent_page_id' => 'int(10) unsigned DEFAULT NULL',
            'author_user_id' => 'int(10) unsigned NOT NULL',
            'assign_user_id' => 'int(10) unsigned DEFAULT NULL',
            'page_type_id' => 'int(10) unsigned NOT NULL',
            'project_id' => 'int(10) unsigned DEFAULT NULL',
            'url' => 'varchar(64) DEFAULT NULL',
            'title' => 'varchar(128) DEFAULT NULL',
            'body' => 'text NOT NULL',
            'progress' => 'tinyint(3) unsigned NOT NULL DEFAULT "0"',
            'level_id' => 'int(10) unsigned DEFAULT NULL',
            'status' => 'enum("Active","Blocked","Deleted","Closed") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `author_user_id` (`author_user_id`)',
            'KEY `assign_user_id` (`assign_user_id`)',
            'KEY `page_type_id` (`page_type_id`)',
            'KEY `project_id` (`project_id`)',
            'KEY `parent_page_id` (`parent_page_id`)',
            'KEY `level` (`level_id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10');

        $this->createTable('page_label',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'page_id' => 'int(10) unsigned NOT NULL',
            'label_id' => 'int(10) unsigned NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `page_id` (`page_id`)',
            'KEY `label_id` (`label_id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2');


        $this->createTable('page_type',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'constant' => 'varchar(64) NOT NULL',
            'title' => 'varchar(64) NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5');


        $this->createTable('project',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'title' => 'varchar(64) NOT NULL',
            'parent_id' => 'int(10) unsigned DEFAULT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `parent_id` (`parent_id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4');


        $this->createTable('project_system_module',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'project_id' => 'int(10) unsigned NOT NULL',
            'system_module_id' => 'int(10) unsigned NOT NULL',
            'params' => 'text',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `project_id` (`project_id`)',
            'KEY `system_module_id` (`system_module_id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7');


        $this->createTable('request',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'browser_id' => 'int(10) unsigned NOT NULL',
            'os_id' => 'int(10) unsigned NOT NULL',
            'user_ip' => 'int(10) unsigned NOT NULL',
            'code' => 'varchar(32) NOT NULL',
            'method_id' => 'int(10) unsigned NOT NULL',
            'url_id' => 'int(10) unsigned NOT NULL',
            'referer_url_id' => 'int(11) unsigned DEFAULT NULL',
            'server_id' => 'int(10) unsigned DEFAULT NULL',
            'branch_id' => 'int(10) unsigned NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `branch_id` (`branch_id`)',
            'KEY `server_id` (`server_id`)',
            'KEY `url_id` (`url_id`)',
            'KEY `method_id` (`method_id`)',
            'KEY `referer_url_id` (`referer_url_id`)',
            'KEY `os_id` (`os_id`)',
            'KEY `browser_id` (`browser_id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');


        $this->createTable('request_data',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'type' => 'varchar(32) NOT NULL',
            'request_id' => 'int(10) unsigned NOT NULL',
            'data' => 'text NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `request_id` (`request_id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');


        $this->createTable('server',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'title' => 'varchar(64) NOT NULL',
            'company_id' => 'int(10) unsigned NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `company_id` (`company_id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

        $this->createTable('system_module',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'name' => 'varchar(32) NOT NULL',
            'title' => 'varchar(64) NOT NULL',
            'description' => 'text NOT NULL',
            'type' => 'enum("user","project","widget") NOT NULL DEFAULT "user"',
            'installation' => 'enum("force","install","not_install","manual") NOT NULL DEFAULT "not_install"',
            'position' => 'int(11) NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14');


        $this->createTable('trace',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'request_id' => 'int(10) unsigned DEFAULT NULL',
            'parent_id' => 'int(10) unsigned DEFAULT NULL',
            'filename' => 'varchar(255) DEFAULT NULL',
            'line' => 'int(11) DEFAULT NULL',
            'method' => 'int(11) DEFAULT NULL',
            'position' => 'int(10) unsigned NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `request_id` (`request_id`)',
            'KEY `parent_id` (`parent_id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

        $this->createTable('trace_argument',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'trace_id' => 'int(10) unsigned NOT NULL',
            'name' => 'varchar(64) DEFAULT NULL',
            'position' => 'mediumint(8) unsigned NOT NULL',
            'value' => 'text NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `trace_id` (`trace_id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

        $this->createTable('trace_code',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'trace_id' => 'int(10) unsigned NOT NULL',
            'line' => 'mediumint(9) NOT NULL',
            'code' => 'varchar(255) NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `trace_id` (`trace_id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

        $this->createTable('url',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'protocol' => 'enum("https","http") NOT NULL DEFAULT "http"',
          'domain' => 'varchar(200) NOT NULL',
          'url' => 'text NOT NULL',
          'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
          'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
          'PRIMARY KEY (`id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');


        $this->createTable('user',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'company_id' => 'int(10) unsigned NOT NULL',
            'login' => 'varchar(32) NOT NULL',
            'email' => 'varchar(128) NOT NULL',
            'password' => 'varchar(32) NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `company_id` (`company_id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2');

        $this->createTable('user_access',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'user_id' => 'int(10) unsigned NOT NULL',
            'access_id' => 'int(10) unsigned NOT NULL',
            'project_id' => 'int(10) unsigned NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `user_id` (`user_id`)',
            'KEY `access_id` (`access_id`)',
            'KEY `project_id` (`project_id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3');


        $this->createTable('user_group',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'user_id' => 'int(10) unsigned NOT NULL',
            'group_id' => 'int(10) unsigned NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `user_id` (`user_id`)',
            'KEY `group_id` (`group_id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2');


        $this->createTable('user_system_module',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'user_id' => 'int(10) unsigned NOT NULL',
            'system_module_id' => 'int(10) unsigned NOT NULL',
            'params' => 'text',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `user_id` (`user_id`)',
            'KEY `module_id` (`system_module_id`)'
        ),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8');

        $this->insert('editor',array(
            'id' => 1,
            'name' => 'html',
            'title' => 'HTML',
            'description' => 'WYSIWYG editor',
            'status' => 'Active',
            'changed' => '2015-03-09 16:32:01'
        ));
        $this->insert('editor',array(
            'id' => 2,
            'name' => 'wiki',
            'title' => 'Wiki',
            'description' => 'Wiki editor',
            'status' => 'Active',
            'changed' => '2015-03-09 16:32:03'
        ));
        $this->insert('level',array(
            'id' =>1,
            'type' => 'Exception',
            'title' => 'info',
            'css_class' => '',
            'weight' => 1,
            'status' => 'Active',
            'changed' => '2014-08-29 21:55:06'
        ));
        $this->insert('level',array(
            'id' => 2,
            'type' => 'Exception',
            'title' => 'warning',
            'css_class' => '',
            'weight' => 10,
            'status' => 'Active',
            'changed' => '2014-08-29 21:55:12'
        ));
        $this->insert('level',array(
            'id' => 3,
            'type' => 'Exception',
            'title' => 'error',
            'css_class' => '',
            'weight' => 20,
            'status' => 'Active',
            'changed' => '2014-08-29 21:55:17'
        ));
        $this->insert('level',array(
            'id' => 4,
            'type' => 'Exception',
            'title' => 'critical',
            'css_class' => '',
            'weight' => 30,
            'status' => 'Active',
            'changed' => '2014-08-29 21:55:20'
        ));
        $this->insert('level',array(
            'id' => 5,
            'type' => 'Page',
            'title' => 'Low',
            'css_class' => '',
            'weight' => 1,
            'status' => 'Active',
            'changed' => '2015-03-14 06:27:04'
        ));
        $this->insert('level',array(
            'id' => 6,
            'type' => 'Page',
            'title' => 'Normal',
            'css_class' => '',
            'weight' => 10 ,
            'status' => 'Active',
            'changed' => '2015-03-14 06:27:04'
        ));
        $this->insert('level',array(
            'id' => 7,
            'type' => 'Page',
            'title' => 'High',
            'css_class' => '',
            'weight' => 20 ,
            'status' => 'Active',
            'changed' => '2015-03-14 06:27:30'
        ));
        $this->insert('level',array(
            'id' => 8,
            'type' => 'Page',
            'title' => 'Urgent',
            'css_class' => '',
            'weight' => 30,
            'status' => 'Active',
            'changed' => '2015-03-14 06:27:30'
        ));
        $this->insert('level',array(
            'id' => 9,
            'type' => 'Page',
            'title' => 'Immediately',
            'css_class' => '',
            'weight' => 100,
            'status' => 'Active',
            'changed' => '2015-03-14 22:05:44'
        ));

        $this->insert('page_type',array(
            'id' => 1,
            'constant' => 'PAGE_TYPE_TICKETS',
            'title' => 'Тикеты',
            'status' => 'Active',
            'changed' => '2015-03-09 12:54:08'
        ));

        $this->insert('page_type',array(
            'id' => 2,
            'constant' => 'PAGE_TYPE_WIKI',
            'title' => 'Wiki',
            'status' => 'Active',
            'changed' => '2015-03-09 12:54:13'
        ));

        $this->insert('page_type',array(
            'id' => 3,
            'constant' => 'PAGE_TYPE_NOTES',
            'title' => 'Пометки',
            'status' => 'Active',
            'changed' => '2015-03-09 12:54:20'
        ));

        $this->insert('page_type',array(
            'id' => 4,
            'constant' => 'PAGE_TYPE_RELEASE',
            'title' => 'Релиз',
            'status' => 'Active',
            'changed' => '2015-03-13 22:43:53'
        ));


        $this->insert('system_module',array(
            'id' => 1,
            'name' => 'dashboard',
            'title' => 'Dashboard',
            'description' => 'Add dashboard',
            'type' => 'user',
            'installation' => 'force',
            'position' => 3,
            'status' => 'Active',
        ));
        $this->insert('system_module',array(
            'id' => 2,
            'name' => 'projects',
            'title' => 'Projects',
            'description' => 'Add project list',
            'type' => 'user',
            'installation' => 'install',
            'position' => 5,
            'status' => 'Active',
        ));
        $this->insert('system_module',array(
            'id' => 3,
            'name' => 'notification',
            'title' => 'Notifications',
            'description' => 'Add notifications in top menu',
            'type' => 'user',
            'installation' => 'install',
            'position' => 9,
            'status' => 'Active',
        ));
        $this->insert('system_module',array(
            'id' => 4,
            'name' => 'messages',
            'title' => 'Messages',
            'description' => 'Add messages in top menu',
            'type' => 'user',
            'installation' => 'install',
            'position' => 11,
            'status' => 'Active',
        ));
        $this->insert('system_module',array(
            'id' => 5,
            'name' => 'search',
            'title' => 'Search panel',
            'description' => 'Add search panel in topmenu',
            'type' => 'user',
            'installation' => 'install',
            'position' => 4,
            'status' => 'Active',
        ));
        $this->insert('system_module',array(
            'id' => 6,
            'name' => 'profile',
            'title' => 'Profile',
            'description' => 'Add profile in top menu',
            'type' => 'user',
            'installation' => 'force',
            'position' => 1,
            'status' => 'Active',
        ));
        $this->insert('system_module',array(
            'id' => 7,
            'name' => 'tickets',
            'title' => 'Tickets',
            'description' => 'Add list of all tickets',
            'type' => 'project',
            'installation' => 'install',
            'position' => 0,
            'status' => 'Active',
        ));
        $this->insert('system_module',array(
            'id' => 8,
            'name' => 'wiki',
            'title' => 'Wiki',
            'description' => 'Add wiki to project',
            'type' => 'project',
            'installation' => 'not_install',
            'position' => 1,
            'status' => 'Active',
        ));
        $this->insert('system_module',array(
            'id' => 9,
            'name' => 'notes',
            'title' => 'Notes',
            'description' => '',
            'type' => 'user',
            'installation' => 'not_install',
            'position' => 15,
            'status' => 'Active',
        ));
        $this->insert('system_module',array(
            'id' => 10,
            'name' => 'settings',
            'title' => 'Settings',
            'description' => 'Project setting',
            'type' => 'project',
            'installation' => 'force',
            'position' => 1000,
            'status' => 'Active',
        ));
        $this->insert('system_module',array(
            'id' => 11,
            'name' => 'tickets',
            'title' => 'Ticket list',
            'description' => '',
            'type' => 'widget',
            'installation' => 'manual',
            'position' => 0,
            'status' => 'Active',
        ));
        $this->insert('system_module',array(
            'id' => 13,
            'name' => 'lastRelease',
            'title' => 'Current Release',
            'description' => '',
            'type' => 'widget',
            'installation' => 'manual',
            'position' => 0,
            'status' => 'Active',
        ));
        $this->addForeignKey('access_ibfk_1','access','company_id','company','id','CASCADE','CASCADE');

        $this->addForeignKey('branch_ibfk_1','branch', 'company_id', 'company', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('company_ibfk_1','company', 'editor_id', 'editor', 'id', 'CASCADE');
        $this->addForeignKey('exception_ibfk_1','exception', 'level_id', 'level', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('group_ibfk_1','group', 'company_id', 'company', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('group_access_ibfk_2','group_access', 'access_id', 'access', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('group_access_ibfk_3','group_access', 'project_id', 'project', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('group_access_ibfk_4','group_access', 'group_id', 'group', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('guest_system_module_ibfk_1','guest_system_module', 'system_module_id', 'system_module', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('label_ibfk_1','label', 'company_id', 'company', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('level_ibfk_1','level', 'company_id', 'company', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('page_ibfk_6','page', 'level_id', 'level', 'id', null,'CASCADE');
        $this->addForeignKey('page_ibfk_1','page', 'author_user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('page_ibfk_2','page', 'assign_user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('page_ibfk_3','page', 'page_type_id', 'page_type', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('page_ibfk_4','page', 'project_id', 'project', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('page_ibfk_5','page', 'parent_page_id', 'page', 'id',null, 'CASCADE');

        $this->addForeignKey('page_label_ibfk_1','page_label', 'page_id', 'page', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('page_label_ibfk_2','page_label', 'label_id', 'label', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('project_ibfk_1','project', 'parent_id', 'project', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('project_system_module_ibfk_1','project_system_module', 'project_id', 'project', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('project_system_module_ibfk_2','project_system_module', 'system_module_id', 'system_module', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('request_ibfk_1','request', 'branch_id', 'branch', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('request_ibfk_2','request', 'url_id', 'url', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('request_ibfk_3','request', 'method_id', 'method', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('request_ibfk_4','request', 'server_id', 'server', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('request_ibfk_5','request', 'referer_url_id', 'url', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('request_ibfk_6','request', 'browser_id', 'browser', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('request_ibfk_7','request', 'os_id', 'os', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('request_data_ibfk_1','request_data', 'request_id', 'request', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('server_ibfk_1','server', 'company_id', 'company', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('trace_ibfk_1','trace', 'request_id', 'request', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('trace_ibfk_2','trace', 'parent_id', 'trace', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('trace_argument_ibfk_1','trace_argument', 'trace_id', 'trace', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('trace_code_ibfk_1','trace_code', 'trace_id', 'trace', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_ibfk_1','user', 'company_id', 'company', 'id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('user_access_ibfk_1','user_access', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_access_ibfk_2','user_access', 'access_id', 'access', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_access_ibfk_3','user_access','project_id', 'project', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_group_ibfk_1','user_group','user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_group_ibfk_2','user_group', 'group_id', 'group', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_system_module_ibfk_1','user_system_module', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_system_module_ibfk_2','user_system_module', 'system_module_id', 'system_module', 'id', 'CASCADE', 'CASCADE');



	}

	public function down() {
		$this->_dropTables();
		$this->_dropTables();
		$this->_dropTables();
		$this->_dropTables();
		$this->_dropTables();
		$this->_dropTables();
	}

    protected function _dropTables() {
        $this->dropTable('access');
        $this->dropTable('branch');
        $this->dropTable('browser');
        $this->dropTable('company');
        $this->dropTable('editor');
        $this->dropTable('exception');
        $this->dropTable('group');
        $this->dropTable('group_access');
        $this->dropTable('guest_system_module');
        $this->dropTable('label');
        $this->dropTable('level');
        $this->dropTable('method');
        $this->dropTable('os');
        $this->dropTable('page');
        $this->dropTable('page_label');
        $this->dropTable('page_type');
        $this->dropTable('project');
        $this->dropTable('project_system_module');
        $this->dropTable('request');
        $this->dropTable('request_data');
        $this->dropTable('server');
        $this->dropTable('system_module');
        $this->dropTable('trace');
        $this->dropTable('trace_argument');
        $this->dropTable('trace_code');
        $this->dropTable('url');
        $this->dropTable('user');
        $this->dropTable('user_access');
        $this->dropTable('user_group');
        $this->dropTable('user_system_module');
    }

    public function dropTable($table) {
        try {
            parent::dropTable($table);
        } catch (Exception $e) {

        }
    }
}