<?php

class m150521_130653_drop_status_column extends EDbMigration
{
	public function up()
	{
        $this->dropColumn('group_project','status');
        $this->dropColumn('group_project','changed');
	}

	public function down()
	{
        $this->addColumn('group_project','status','enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"');
        $this->addColumn('group_project','changed','timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
	}

}