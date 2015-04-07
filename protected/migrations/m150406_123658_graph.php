<?php

class m150406_123658_graph extends EDbMigration
{
	public function up()  {
        $this->createTable('graph', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'constant' => 'VARCHAR( 64 ) NOT NULL',
            'name' => 'varchar(32) NOT NULL',
            'title' => 'varchar(64) NOT NULL',
            'engine' => 'varchar(16) DEFAULT NULL',
            'is_multy_stat' => 'enum("Yes","No") NOT NULL DEFAULT "No"',
            'is_with_history' => 'enum("Yes","No") NOT NULL DEFAULT "No"',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)',
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
        $this->insert('graph',array(
            'id' => 1,
            'constant' => 'GRAPH_CHART_LINE',
            'name' => 'ChartLine',
            'title' => 'Line',
            'engine' => 'Chart',
            'is_multy_stat' => 'Yes',
            'is_with_history' => 'Yes'
        ));
        $this->insert('graph',array(
            'id' => 2,
            'constant' => 'GRAPH_NATIVE_PIE',
            'name' => 'NativePie',
            'title' => 'Pie native',
            'engine' => 'Native',
            'is_multy_stat' => 'No',
            'is_with_history' => 'No'
        ));
        $this->insert('graph',array(
            'id' => 3,
            'constant' => 'GRAPH_CHART_BAR',
            'name' => 'ChartBar',
            'title' => 'Bar',
            'engine' => 'Chart',
            'is_multy_stat' => 'Yes',
            'is_with_history' => 'Yes'
        ));
        $this->insert('graph',array(
            'id' => 4,
            'constant' => 'GRAPH_CHART_POLAR_AREA',
            'name' => 'ChartPolarArea',
            'title' => 'Polar Area',
            'engine' => 'Chart',
            'is_multy_stat' => 'Yes',
            'is_with_history' => 'No'
        ));
        $this->insert('graph',array(
            'id' => 5,
            'constant' => 'GRAPH_CHART_PIE',
            'name' => 'ChartPie',
            'title' => 'Pie',
            'engine' => 'Chart',
            'is_multy_stat' => 'Yes',
            'is_with_history' => 'No'
        ));
        $this->insert('graph',array(
            'id' => 6,
            'constant' => 'GRAPH_CHART_RADAR',
            'name' => 'ChartRadar',
            'title' => 'Radar',
            'engine' => 'Chart',
            'is_multy_stat' => 'Yes',
            'is_with_history' => 'Yes'
        ));
	}

	public function down()	{
        $this->dropTable('graph');
	}

}