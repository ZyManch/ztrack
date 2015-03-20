<?php

class m150320_101343_user_for_history extends EDbMigration
{
	public function up() {
        $this->execute(
            'ALTER TABLE  `page_history` ADD  `user_id` INT UNSIGNED NOT NULL AFTER  `id` ,
            ADD INDEX (  `user_id` )');
        $this->addForeignKey('page_history_ibfk_6','page_history','user_id','user','id','CASCADE','CASCADE');
	}

	public function down() {
        $this->dropForeignKey('page_history_ibfk_6','page_history');
		$this->dropColumn('page_history','user_id');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}