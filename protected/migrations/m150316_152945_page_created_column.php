<?php

class m150316_152945_page_created_column extends EDbMigration {
	public function up() {
        $this->execute('ALTER TABLE  `page` ADD  `created` TIMESTAMP NULL DEFAULT NULL AFTER  `status`');
	}

	public function down() {
        $this->execute('ALTER TABLE `page` DROP `created`');
	}
}