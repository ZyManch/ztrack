<?php

class m150410_125841_token extends EDbMigration
{
	public function up()
	{

        $this->createTable('token', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'hash' => 'char(64) NOT NULL',
            'user_id' => 'int(11) unsigned DEFAULT NULL',
            'project_id' => 'int(11) unsigned DEFAULT NULL',
            'type' => 'enum("Private","Public") NOT NULL DEFAULT "Private"',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `user_id` (`user_id`)',
            'KEY `project_id` (`project_id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

        $this->addForeignKey(
            'token_ibfk_2',
            'token',
            'project_id',
            'project',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'token_ibfk_1',
            'token',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

	}

	public function down()
	{
		$this->dropTable('token');
	}

}