<?php

class m150620_094215_remove_status_and_changed_columns extends EDbMigration {

    protected $_tables = array(
        'user_group',
        'guest_system_module',
        'page_label',
        'page_history',
        'trace_argument',
        'trace_code',
    );

	public function up() {
        foreach ($this->_tables as $table) {
            $this->_removeColumns($table);
        }
	}

	public function down() {
        foreach ($this->_tables as $table) {
            $this->_addColumns($table);
        }
	}

    protected function _removeColumns($table) {
        try {
            $this->dropColumn($table, 'status');
        } catch (Exception $e) {

        }
        try {
            $this->dropColumn($table,'changed');
        } catch (Exception $e) {

        }
    }

    protected function _addColumns($table) {
        $this->addColumn($table,'status','enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"');
        $this->addColumn($table,'changed','timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
    }

}