<?php

class m150408_071804_new_widgets extends EDbMigration
{
	public function up()
	{
        $this->insert('system_module',array(
            'id' => 14,
            'name' => 'projectTickets',
            'title' => 'Project tickets stat',
            'description' => '',
            'type' => 'widget',
            'installation' => 'manual',
            'position' => 0,

        ));
        $this->insert('system_module',array(
            'id' => 15,
            'name' => 'statistic',
            'title' => 'Statistic',
            'description' => '',
            'type' => 'widget',
            'installation' => 'manual',
            'position' => 0,

        ));
	}

	public function down()
	{
		$this->delete('system_module','id in (:id1,:id2)',array(':id1'=>14,':id2'=>15));
	}

}