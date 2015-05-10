<?php

class m150510_072904_stat_column_label extends EDbMigration
{
	public function up()
	{
        $this->execute('ALTER TABLE  `statistic_column` ADD  `label` VARCHAR( 64 ) NOT NULL AFTER  `name`');
	}

	public function down() {
		$this->dropColumn('statistic_column','label');
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