<?php

class m150316_155358_messages extends EDbMigration {

	public function up() {
        $this->createTable('message',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'user_id' => 'int(10) unsigned NOT NULL',
            'body' => 'TEXT NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `user_id` (`user_id`)',
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');



        $this->createTable('page_message', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'page_id' => 'int(10) unsigned NOT NULL',
            'message_id' => 'int(10) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `page_id`(`page_id`)',
            'KEY `message_id`(`message_id`)'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1') ;


        $this->createTable('user_message',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'user_id' => 'int(10) unsigned NOT NULL',
            'message_id' => 'int(10) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `user_id` (`user_id`)',
            'KEY `message_id` (`message_id`)'
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');

        $this->addForeignKey('message_ibfk_1','message','user_id','user','id', 'CASCADE','CASCADE');

        $this->addForeignKey('page_message_ibfk_2','page_message','message_id','message','id','CASCADE','CASCADE');
        $this->addForeignKey('page_message_ibfk_1','page_message','page_id','page','id','CASCADE','CASCADE');
        $this->addForeignKey('user_message_ibfk_2','user_message','message_id','message','id','CASCADE','CASCADE');
        $this->addForeignKey('user_message_ibfk_1','user_message','user_id','user','id','CASCADE','CASCADE');
	}

	public function down(){
		$this->dropTable('user_message');
		$this->dropTable('page_message');
		$this->dropTable('message');
	}

}