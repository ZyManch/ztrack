<?php

class m150511_124717_messenger extends EDbMigration
{
	public function up()
	{
        $this->createTable('messenger', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'type' => 'varchar(16) NOT NULL',
            'title' => 'varchar(64) NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)'
        ), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3');

        $this->insert('messenger',array(
            'id' => 1,
            'type' => 'email',
            'title' => 'EMail'
        ));
        $this->insert('messenger',array(
            'id' => 2,
            'type' => 'message',
            'title' => 'Message'
        ));

	}

	public function down()
	{
		$this->dropTable('messenger');
	}

}