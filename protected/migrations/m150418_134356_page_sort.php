<?php

class m150418_134356_page_sort extends EDbMigration
{
	public function up()
	{
        $this->execute('ALTER TABLE  `page` ADD  `position` MEDIUMINT UNSIGNED NULL DEFAULT NULL AFTER  `level_id`');
	}

	public function down()
	{
		$this->dropColumn('page','position');
	}

}