<?php

class m150317_104328_message_created extends EDbMigration
{
	public function up(){
        $this->execute('ALTER TABLE  `message` ADD  `created` TIMESTAMP NULL DEFAULT NULL AFTER  `status`');
	}

	public function down() {
		$this->dropColumn('message','created');
	}

}