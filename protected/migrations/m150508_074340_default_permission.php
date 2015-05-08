<?php

class m150508_074340_default_permission extends EDbMigration
{
	public function up()
	{
        $this->execute('ALTER TABLE  `permission` ADD  `default_checked` ENUM(  "Yes",  "No" ) NOT NULL DEFAULT  "No" AFTER  `position`');
        $this->update('permission',array('default_checked' => 'Yes'),'id in (5,6,8,11,13)');
	}

	public function down()
	{
		$this->dropColumn('permission','default_checked');
	}


}