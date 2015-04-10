<?php

class m150410_112529_module_position extends EDbMigration
{
	public function up()
	{
        $this->execute('ALTER TABLE  `dashboard_system_module` ADD  `position` INT UNSIGNED NOT NULL AFTER  `params`');
	}

	public function down()
	{
		$this->dropColumn('dashboard_system_module','position');
	}
}