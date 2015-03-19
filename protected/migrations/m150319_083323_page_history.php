<?php

class m150319_083323_page_history extends EDbMigration
{
	public function up()	{
        $this->createTable('page_history',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'previous_page_history_id' => 'int(10) unsigned DEFAULT NULL',
            'assign_user_id' => 'int(10) unsigned DEFAULT NULL',
            'page_id' => 'int(10) unsigned DEFAULT NULL',
            'project_id' => 'int(10) unsigned DEFAULT NULL',
            'title' => 'varchar(128) DEFAULT NULL',
            'body' => 'text NOT NULL',
            'progress' => 'tinyint(3) unsigned NOT NULL DEFAULT "0"',
            'level_id' => 'int(10) unsigned DEFAULT NULL',
            'status' => 'enum("Active","Blocked","Deleted","Closed") NOT NULL DEFAULT "Active"',
            'created' => 'timestamp NULL DEFAULT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `project_id` (`project_id`)',
            'KEY `previous_page_history_id` (`previous_page_history_id`)',
            'KEY `page_id` (`page_id`)',
            'KEY `level` (`level_id`)'
        ) ,'ENGINE=InnoDB  DEFAULT CHARSET=utf8') ;
        $this->addForeignKey('page_history_ibfk_4','page_history','level_id','level','id','CASCADE','CASCADE');
        $this->addForeignKey('page_history_ibfk_1','page_history','previous_page_history_id','page_history','id',null,'CASCADE');
        $this->addForeignKey('page_history_ibfk_2','page_history','page_id','page','id','CASCADE','CASCADE');
        $this->addForeignKey('page_history_ibfk_3','page_history','project_id','project','id','CASCADE','CASCADE');
        $this->addForeignKey('page_history_ibfk_5','page_history','assign_user_id','user','id','CASCADE','CASCADE');

	}

	public function down()	{
		$this->dropTable('page_history');
	}

}