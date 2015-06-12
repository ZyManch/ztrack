<?php

class m150612_134307_queue_error extends EDbMigration
{
	public function up()
	{
        $this->createTable('queue_error', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'item' => 'text',
            'eta' => 'int(10) unsigned NOT NULL',
            'PRIMARY KEY (`id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
	}

	public function down()
	{
		$this->dropTable('queue_error');
	}

}