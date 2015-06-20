<?php

class m150620_085149_module_group extends EDbMigration
{
	public function up()
	{
        $this->insert('system_module', array(
            'id' => 18,
            'name'  => 'groups',
            'title'   => 'Groups',
            'description'   => 'Groups list',
            'type'   => 'user',
            'installation'   => 'not_install',
            'permission_id'   => 5,
            'position'   => 6,
        ));
	}

	public function down()
	{
        $this->delete('system_module','id=18');
	}


}