<?php

class m150620_090246_hidden_user_group extends EDbMigration {
	public function up() {
        $this->execute('ALTER TABLE  `group` ADD  `type` ENUM(  "Normal",  "Hidden" ) NOT NULL DEFAULT  "Normal" AFTER  `title`');
	}

	public function down() {
		$this->execute('ALTER TABLE `group` DROP `type`');
	}
}