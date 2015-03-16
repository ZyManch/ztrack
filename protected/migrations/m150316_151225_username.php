<?php

class m150316_151225_username extends EDbMigration {

	public function up() {
        $this->execute('ALTER TABLE  `user` ADD  `username` VARCHAR( 128 ) NOT NULL AFTER  `login`');
	}

	public function down() {
		$this->execute('ALTER TABLE `user` DROP `username`');
	}
}