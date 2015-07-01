<?php

class m150630_061509_database extends EDbMigration
{
	public function up()
	{
        $this->insert('permission', array(
            'id' => 15,
            'constant'  => 'PERMISSION_DATABASE_VIEW',
            'title'  => 'View database',
            'group'  => 7,
            'position'  => 0,
            'default_checked'  => 'Yes',
        ));
        $this->insert('permission', array(
            'id' => 16,
            'constant'  => 'PERMISSION_DATABASE_MANAGE',
            'title'  => 'Database manage',
            'group'  => 7,
            'position'  => 1,
            'default_checked'  => 'No',
        ));
        $this->insert('system_module',array(
            'id' => 19,
            'name' => 'database',
            'title' => 'Database',
            'description' => '',
            'type' => 'project',
            'installation' => 'not_install',
            'permission_id' => 15,
            'position' => 9
        ));

        $this->createTable('project_database', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'project_id' => 'int(10) unsigned NOT NULL',
            'environment_id' => 'int(10) unsigned NOT NULL',
            'hostname' => ' varchar(128) NOT NULL',
            'port' => ' int(10) unsigned DEFAULT NULL',
            'username' => ' varchar(128) NOT NULL',
            'password' => ' varchar(128) NOT NULL',
            'database_list' => ' text NOT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `environment_id` (`environment_id`)',
            'KEY `project_id` (`project_id`)'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
        $this->addForeignKey('project_database_ibfk_1','project_database','project_id','project','id','CASCADE','CASCADE');
        $this->addForeignKey('project_database_ibfk_2','project_database','environment_id','environment','id',null,'CASCADE');

	}

	public function down()
	{
        $this->delete('system_module','id in (19)');
		$this->delete('permission','id in(15,16)');
        $this->dropForeignKey('project_database_ibfk_1','project_database');
        $this->dropForeignKey('project_database_ibfk_2','project_database');
        $this->dropTable('project_database');
	}

}