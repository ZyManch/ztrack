<?php

class m150521_140644_drop_settings_module extends EDbMigration
{
	public function up()
	{
        $this->delete('system_module','id=10');
	}

	public function down()
	{
		$this->insert('system_module',array(
            'id' => 10,
            'name' => 'settings',
            'title' => 'Settings',
            'description' => 'Project setting',
            'type' => 'project',
            'installation' => 'force',
            'permission_id' => 3,
            'position' => 1000
        ));
	}

}