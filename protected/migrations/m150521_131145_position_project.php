<?php

class m150521_131145_position_project extends EDbMigration
{
	public function up()
	{
        $this->execute('ALTER TABLE  `project` ADD  `position` INT NOT NULL AFTER  `parent_id`');
	}

	public function down()
	{
		$this->dropColumn('project','position');
	}

}