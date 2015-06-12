<?php

class m150612_110226_environment extends EDbMigration
{
	public function up()
	{
        $this->createTable('environment', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'title' => 'varchar(64) NOT NULL',
            'company_id' => 'int(10) unsigned NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'PRIMARY KEY (`id`)'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
        $this->execute('ALTER TABLE  `environment` ADD INDEX (  `company_id` )');
        $this->execute('ALTER TABLE  `error` ADD  `environment_id` INT UNSIGNED NOT NULL AFTER  `branch_id`');
        $this->execute('ALTER TABLE  `error` ADD INDEX (  `environment_id` )');
        $this->addForeignKey('error_ibfk_4','error','environment_id','environment','id','RESTRICT','CASCADE');
        $this->addForeignKey('environment_ibfk_1','environment','company_id','company','id','CASCADE','CASCADE');
	}

	public function down()
	{
        $this->dropForeignKey('environment_ibfk_1','environment');
        $this->dropForeignKey('error_ibfk_4','error');
        $this->dropColumn('error','environment_id');
		$this->dropTable('environment');
	}

}