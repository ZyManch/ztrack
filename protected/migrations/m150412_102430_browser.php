<?php

class m150412_102430_browser extends EDbMigration
{
	public function up()
	{
        $this->dropColumn('browser','name');
	}

	public function down()
	{
        $this->execute('ALTER TABLE `browser` ADD COLUMN `name` varchar(32) NOT NULL DEFAULT "unknown" ');
	}

}