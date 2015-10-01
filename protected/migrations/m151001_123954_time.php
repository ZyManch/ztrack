<?php

class m151001_123954_time extends EDbMigration
{
	public function up()
	{
        $this->createTable('user_time', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'user_id' => 'int(10) unsigned NOT NULL',
            'page_id' => 'int(10) unsigned DEFAULT NULL',
            'description' => 'text NOT NULL',
            'started' => 'timestamp NOT NULL',
            'finished' => 'timestamp NOT NULL',
            'duration' => 'mediumint(8) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `user_id` (`user_id`)',
            'KEY `page_id` (`page_id`)',
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
        $this->addForeignKey(
            'user_time_ibfk_1',
            'user_time',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'user_time_ibfk_2',
            'user_time',
            'page_id',
            'page',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->insert('system_module',array(
            'id' => 20,
            'name' => 'timer',
            'title' => 'Timer',
            'description' => '',
            'type' => 'user',
            'installation' => 'not_install',
            'permission_id' => 6,
            'position' => 6,
            'status' => 'Active',
            'changed' => '2015-10-01 12:49:55'
        ));

	}

	public function down()
	{
		$this->dropForeignKey('user_time_ibfk_2','user_time');
		$this->dropForeignKey('user_time_ibfk_1','user_time');
		$this->dropTable('user_time');
        $this->delete('system_module','id=20');

	}

}