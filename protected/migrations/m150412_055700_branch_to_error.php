<?php

class m150412_055700_branch_to_error extends EDbMigration
{
	public function up()
	{
        $this->dropForeignKey('request_ibfk_1','request');
        $this->dropColumn('request','branch_id');
        $this->execute(
            'ALTER TABLE  `error` ADD  `branch_id` INT UNSIGNED NOT NULL AFTER  `project_id` ,
            ADD INDEX (  `branch_id` )'
        );
        $this->addForeignKey(
            'error_ibfk_3',
            'error',
            'branch_id',
            'branch',
            'id',
            null,
            'CASCADE'
        );
	}

	public function down()
	{
        try {
            $this->dropForeignKey('error_ibfk_3', 'error');
            $this->dropColumn('error', 'branch_id');
            $this->execute(
                'ALTER TABLE `request` ADD `branch_id` int(10) unsigned NOT NULL AFTER `server_id`,
                ADD INDEX (  `branch_id` )'
            );
            $this->addForeignKey('request_ibfk_1', 'request', 'branch_id', 'branch', 'id', 'CASCADE', 'CASCADE');
        } catch (Exception $e) {

        }
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}