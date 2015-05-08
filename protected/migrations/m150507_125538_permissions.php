<?php

class m150507_125538_permissions extends EDbMigration
{
	public function up()
	{
        $this->update('permission',array(
            'constant' =>  'PERMISSION_USER_MANAGE',
            'title' =>  'Администрировать пользователей'
        ),'id =2');
	}

	public function down()
	{

	}

}