<?php

class m150410_140016_error extends EDbMigration
{
	public function up()
	{
        $this->renameTable('exception','error');
        $this->execute('ALTER TABLE  `request` ADD  `error_id` INT UNSIGNED NOT NULL AFTER  `id`');
        $this->execute('ALTER TABLE  `request` ADD INDEX (  `error_id` ) ');
        $this->addForeignKey(
            'request_ibfk_9',
            'request',
            'error_id',
            'error',
            'id',
            'CASCADE',
            'CASCADE'
        );
	}

	public function down()
	{
        try {
            $this->renameTable('error', 'exception');
            $this->dropColumn('request', 'error_id');
        } catch (Exception $e) {

        }

	}

}