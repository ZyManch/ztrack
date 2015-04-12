<?php

class m150412_050848_error_hash extends EDbMigration
{
	public function up()
	{
        $this->execute(
            'ALTER TABLE  `error` ADD  `hash` CHAR( 32 ) NOT NULL AFTER  `title` ,
            ADD UNIQUE (`hash`)'
        );
        $this->execute(
            'ALTER TABLE  `error` ADD  `project_id` INT UNSIGNED NULL DEFAULT NULL AFTER  `level_id` ,
            ADD INDEX (  `project_id` )'
        );
        $this->addForeignKey(
            'error_ibfk_2',
            'error',
            'project_id',
            'project',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->execute(
            'ALTER TABLE  `project` ADD  `company_id` INT UNSIGNED NOT NULL AFTER  `title` ,
            ADD INDEX (  `company_id` )'
        );
        $this->update('project',array('company_id'=>1));
        $this->addForeignKey(
            'project_ibfk_2',
            'project',
            'company_id',
            'company',
            'id',
            'CASCADE',
            'CASCADE'
        );
	}

	public function down()
	{
        $this->dropForeignKey('project_ibfk_2','project');
        $this->dropForeignKey('error_ibfk_2','error');
		$this->dropColumn('error','project_id');
		$this->dropColumn('project','company_id');
		$this->dropColumn('error','hash');
	}

}