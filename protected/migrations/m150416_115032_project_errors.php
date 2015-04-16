<?php

class m150416_115032_project_errors extends EDbMigration
{
	public function up()
	{
        
        $this->insert('system_module',array(
            'id' => 16,
            'name' => 'errors',
            'title' => 'Errors',
            'description' => 'List of errors',
            'type' => 'project',
            'installation' => 'not_install',
            'position' => 10,
        ));
	}

	public function down()
	{
		$this->delete('system_module','id=16');
	}


}