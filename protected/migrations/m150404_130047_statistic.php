<?php

class m150404_130047_statistic extends EDbMigration
{
	public function up()
	{
        $this->createTable('statistic', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'company_id' => 'int(10) unsigned NOT NULL',
            'name' => 'varchar(64) NOT NULL',
            'interval'=>'enum("Minute","Hour","Day","Week","Month") NOT NULL DEFAULT "Day"',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `company_id` (`company_id`)'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
        $this->addForeignKey('statistic_ibfk_1','statistic','company_id','company','id','CASCADE','CASCADE');
        $this->createTable('statistic_point' ,array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'statistic_id' => 'int(10) unsigned NOT NULL',
            'date' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'value' => 'decimal(12,4) NOT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `statistic_id` (`statistic_id`)'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $this->addForeignKey(
            'statistic_point_ibfk_1',
            'statistic_point',
            'statistic_id',
            'statistic',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->createTable('group_statistic',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'group_id' => 'int(10) unsigned NOT NULL',
            'statistic_id' => 'int(10) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `group_id` (`group_id`)',
            'KEY `statistic_id` (`statistic_id`)'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
        $this->addForeignKey(
            'group_statistic_ibfk_2',
            'group_statistic',
            'statistic_id',
            'statistic',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'group_statistic_ibfk_1',
            'group_statistic',
            'group_id',
            'group',
            'id',
            'CASCADE',
            'CASCADE'
        );
	}

	public function down()
	{
        $this->dropTable('group_statistic');
        $this->dropTable('statistic_point');
        $this->dropTable('statistic');


	}


}