<?php

class m150508_090610_delete_login extends EDbMigration
{
	public function up()
	{
        $this->dropColumn('user','login');
	}

	public function down()
	{
		$this->execute('ALTER TABLE  `user` ADD  `login` VARCHAR( 32 ) NOT NULL AFTER  `username`');
	}

}