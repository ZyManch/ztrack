<?php

class m150318_105325_user_page extends EDbMigration {

	public function up() {

        $this->createTable('user_page',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'user_id' => 'int(11) unsigned NOT NULL',
            'page_id' => 'int(11) unsigned NOT NULL',
            'is_assigned' => 'enum("Yes","No") NOT NULL DEFAULT "No"',
            'position' => 'INT NOT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `user_id` (`user_id`)',
            'KEY `page_id` (`page_id`)'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1') ;

        $this->addForeignKey('user_page_ibfk_2','user_page','page_id','page','id','CASCADE','CASCADE');
        $this->addForeignKey('user_page_ibfk_1','user_page','user_id','user','id','CASCADE','CASCADE');

        $this->dropForeignKey('page_ibfk_2','page');
        $this->dropColumn('page','assign_user_id');
    }

	public function down() {
		$this->dropTable('user_page');
	}
}