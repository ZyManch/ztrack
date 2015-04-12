<?php

class m150412_123202_fix_error_table extends EDbMigration
{
	public function up()
	{
        $this->execute('ALTER TABLE  `error` CHANGE  `title`  `title` VARCHAR( 128 ) NOT NULL');
	}

	public function down()
	{
		echo "m150412_123202_fix_error_table does not support migration down.\n";
		return false;
	}

}