<?php

class m150405_040935_dashboard extends EDbMigration
{
	public function up()
	{
        $this->createTable('dashboard', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'user_id' => 'int(10) unsigned DEFAULT NULL',
            'project_id' => 'int(10) unsigned DEFAULT NULL',
            'name' => 'varchar(64) NOT NULL',
            'position' => 'mediumint(8) unsigned NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `user_id` (`user_id`)',
            'KEY `project_id` (`project_id`)',
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');


        $this->addForeignKey(
            'dashboard_ibfk_2',
            'dashboard',
            'project_id',
            'project',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'dashboard_ibfk_1',
            'dashboard',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );


        $this->createTable('dashboard_system_module', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'dashboard_id' => 'int(10) unsigned NOT NULL',
            'system_module_id' => 'int(10) unsigned NOT NULL',
            'type' => 'enum("Default","Warning","Info","Danger") NOT NULL DEFAULT "Default"',
            'title' => 'varchar(64) NOT NULL',
            'rows' => 'tinyint(3) unsigned NOT NULL DEFAULT 6',
            'params' => 'text DEFAULT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `dashboard_id` (`dashboard_id`)',
            'KEY `system_module_id` (`system_module_id`)',
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

        $this->addForeignKey(
            'dashboard_system_module_ibfk_2',
            'dashboard_system_module',
            'system_module_id',
            'system_module',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'dashboard_system_module_ibfk_1',
            'dashboard_system_module',
            'dashboard_id',
            'dashboard',
            'id',
            'CASCADE',
            'CASCADE'
        );
	}

	public function down()
	{
		$this->dropTable('dashboard_system_module');
		$this->dropTable('dashboard');
	}
}