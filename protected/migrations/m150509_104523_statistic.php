<?php

class m150509_104523_statistic extends EDbMigration
{
	public function up()
	{

        $this->createTable('statistic_column', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'statistic_id' => 'int(10) unsigned NOT NULL',
            'name' => 'varchar(64) NOT NULL',
            'description' => 'text',
            'type' => 'enum("Int","Float","Date","String") NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
            'KEY `statistic_id` (`statistic_id`)'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1');

        $this->addForeignKey(
            'statistic_column_ibfk_1',
            'statistic_column',
            'statistic_id',
            'statistic',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->dropColumn('statistic_point','date');
        $this->dropColumn('statistic_point','value');

        $this->createTable('statistic_data_int', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'statistic_column_id' => 'int(10) unsigned NOT NULL',
            'statistic_point_id' => 'int(10) unsigned NOT NULL',
            'value' => 'bigint(20) NOT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `statistic_column_id` (`statistic_column_id`)',
            'KEY `statistic_point_id` (`statistic_point_id`)'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1') ;

        $this->addForeignKey(
            'statistic_data_int_ibfk_2',
            'statistic_data_int',
            'statistic_point_id',
            'statistic_point',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'statistic_data_int_ibfk_1',
            'statistic_data_int',
            'statistic_column_id',
            'statistic_column',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->createTable('statistic_data_date', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'statistic_column_id' => 'int(10) unsigned NOT NULL',
            'statistic_point_id' => 'int(10) unsigned NOT NULL',
            'value' => 'date NOT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `statistic_column_id` (`statistic_column_id`)',
            'KEY `statistic_point_id` (`statistic_point_id`)'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1') ;

        $this->addForeignKey(
            'statistic_data_date_ibfk_2',
            'statistic_data_date',
            'statistic_point_id',
            'statistic_point',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'statistic_data_date_ibfk_1',
            'statistic_data_date',
            'statistic_column_id',
            'statistic_column',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->createTable('statistic_data_float', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'statistic_column_id' => 'int(10) unsigned NOT NULL',
            'statistic_point_id' => 'int(10) unsigned NOT NULL',
            'value' => 'double NOT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `statistic_column_id` (`statistic_column_id`)',
            'KEY `statistic_point_id` (`statistic_point_id`)'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1') ;

        $this->addForeignKey(
            'statistic_data_float_ibfk_2',
            'statistic_data_float',
            'statistic_point_id',
            'statistic_point',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'statistic_data_float_ibfk_1',
            'statistic_data_float',
            'statistic_column_id',
            'statistic_column',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->createTable('statistic_data_string', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'statistic_column_id' => 'int(10) unsigned NOT NULL',
            'statistic_point_id' => 'int(10) unsigned NOT NULL',
            'statistic_data_string_value_id' => 'int(10) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `statistic_column_id` (`statistic_column_id`)',
            'KEY `statistic_point_id` (`statistic_point_id`)'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1') ;

        $this->addForeignKey(
            'statistic_data_string_ibfk_2',
            'statistic_data_string',
            'statistic_point_id',
            'statistic_point',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'statistic_data_string_ibfk_1',
            'statistic_data_string',
            'statistic_column_id',
            'statistic_column',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->createTable('statistic_data_string_value',array(
            'id' => 'INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'value' => 'TEXT NOT NULL'
        ), 'ENGINE = INNODB');
        $this->addForeignKey(
            'statistic_data_string_ibfk_3',
            'statistic_data_string',
            'statistic_data_string_value_id',
            'statistic_data_string_value',
            'id',
            'CASCADE',
            'CASCADE'
        );
	}

	public function down()
	{
		$this->dropForeignKey('statistic_column_ibfk_1','statistic_column');
        $this->dropTable('statistic_column');
        $this->addColumn('statistic_point','date','timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->addColumn('statistic_point','date','value','decimal(12,4) NOT NULL');
        $this->dropForeignKey('statistic_data_string_ibfk_3','statistic_data_string');
        $this->dropForeignKey('statistic_data_string_ibfk_2','statistic_data_string');
        $this->dropForeignKey('statistic_data_string_ibfk_1','statistic_data_string');
        $this->dropForeignKey('statistic_data_int_ibfk_1','statistic_data_int');
        $this->dropForeignKey('statistic_data_int_ibfk_2','statistic_data_int');
        $this->dropForeignKey('statistic_data_float_ibfk_1','statistic_data_float');
        $this->dropForeignKey('statistic_data_float_ibfk_2','statistic_data_float');
        $this->dropForeignKey('statistic_data_date_ibfk_2','statistic_data_date');
        $this->dropTable('statistic_data_string_value');
        $this->dropTable('statistic_data_string');
        $this->dropTable('statistic_data_int');
        $this->dropTable('statistic_data_float');
        $this->dropTable('statistic_data_date');
	}

}