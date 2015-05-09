<?php

class m150404_112425_new_access_format extends EDbMigration{

	public function up() {
        $this->dropForeignKey('group_access_ibfk_2','group_access');
        $this->createTable('group_project_module',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'group_project_id' => 'int(10) unsigned NOT NULL',
            'system_module_id' => 'int(10) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `group_project_id` (`group_project_id`)',
            'KEY `system_module_id` (`system_module_id`)',
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
        $this->dropTable('access');
        $this->renameTable('group_access','group_project');
        $this->dropColumn('group_project','access_id');

        $this->addForeignKey(
            'group_project_module_ibfk_2',
            'group_project_module',
            'system_module_id',
            'system_module',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'group_project_module_ibfk_1',
            'group_project_module',
            'group_project_id',
            'group_project',
            'id',
            'CASCADE',
            'CASCADE'
        );
	}

	public function down() {

	}

}