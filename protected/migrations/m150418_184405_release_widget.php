<?php

class m150418_184405_release_widget extends EDbMigration
{
	public function up(){
        $this->insert('system_module',array(
            'name' => 'release',
            'title' => 'Release',
            'description' => 'Releases',
            'type' => 'project',
            'installation'=>'not_install',
            'position'=>4
        ));
        $this->update('system_module',array('position'=>7),'id=8');
	}

	public function down(){
		$this->delete('system_module','id=17');
        $this->update('system_module',array('position'=>1),'id=8');
	}

}