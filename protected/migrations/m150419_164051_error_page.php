<?php

class m150419_164051_error_page extends EDbMigration
{
	public function up()
	{

        $this->createTable('page_error', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'error_id' => 'int(10) unsigned NOT NULL',
            'page_id' => 'int(10) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `error_id` (`error_id`)',
            'KEY `page_id` (`page_id`)',
        ), 'ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1');

        $this->addForeignKey(
            'page_error_ibfk_2',
            'page_error',
            'page_id',
            'page',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'page_error_ibfk_1',
            'page_error',
            'error_id',
            'error',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->insert(
            'page_type',
            array(
                'id' => 5,
                'constant'=>'PAGE_TYPE_ERROR',
                'title' => 'Ошибки'
            )
        );
	}

	public function down()
	{
		$this->dropTable('page_error');
        $this->delete('page_type','id=5');
	}
}