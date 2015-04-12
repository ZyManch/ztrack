<?php

class m150412_102429_os extends EDbMigration
{
	public function up()
	{
        $this->dropColumn('os','name');
        $this->execute('ALTER TABLE  `os` ADD  is_device ENUM(  "Yes",  "No" ) NOT NULL DEFAULT  "No" AFTER  `os`');
	}

	public function down()
	{
		$this->execute('ALTER TABLE `os` ADD COLUMN `name` varchar(32) NOT NULL DEFAULT "unknown" AFTER `os`');
        $this->dropColumn('os','is_device');
	}

}