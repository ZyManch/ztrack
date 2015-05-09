<?php

class m150404_110815_drop_user_access extends EDbMigration {
	public function up(){
        $this->dropTable('user_access');
	}

	public function down(){

	}

}