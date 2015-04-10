<?php

class m150410_081401_flot_graphs extends EDbMigration
{
	public function up()
	{
        $this->insert('graph',array(
            'id'=>7,
            'constant'=>'GRAPH_FLOT_BAR',
            'name'=>'FlotBar',
            'title'=>'Bar',
            'engine'=>'Flot',
            'is_multy_stat'=>'Yes',
            'is_with_history'=>'Yes',
        ));
        $this->insert('graph',array(
            'id'=>8,
            'constant'=>'GRAPH_FLOT_LINE',
            'name'=>'FlotLine',
            'title'=>'Line',
            'engine'=>'Flot',
            'is_multy_stat'=>'Yes',
            'is_with_history'=>'Yes',
        ));
        $this->insert('graph',array(
            'id'=>10,
            'constant'=>'GRAPH_FLOT_PIE',
            'name'=>'FlotPie',
            'title'=>'Pie',
            'engine'=>'Flot',
            'is_multy_stat'=>'Yes',
            'is_with_history'=>'No',
        ));
	}

	public function down()
	{
		$this->delete('graph','id in(7,8,10)');
	}


}