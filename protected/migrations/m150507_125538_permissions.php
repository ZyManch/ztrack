<?php

class m150507_125538_permissions extends EDbMigration
{
	public function up()
	{
        $this->update('permission',array(
            'constant' =>  'PERMISSION_USER_MANAGE',
            'title' =>  'Manage users'
        ),'id =2');
	}

	public function down()
	{

	}

}