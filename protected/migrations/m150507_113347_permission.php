<?php

class m150507_113347_permission extends EDbMigration
{
	public function up()
	{
        $this->createTable('permission',array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'constant' => 'varchar(64) NOT NULL',
            'title' => 'varchar(64) NOT NULL',
            'group' => 'int(11) NOT NULL',
            'position' => 'int(11) NOT NULL',
            'status' => 'enum("Active","Blocked","Deleted") NOT NULL DEFAULT "Active"',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'PRIMARY KEY (`id`)'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1');
        $this->createTable('user_permission', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'user_id' => 'int(10) unsigned NOT NULL',
            'permission_id' => 'int(10) unsigned NOT NULL',
            'PRIMARY KEY (`id`)',
            'KEY `user_id` (`user_id`)',
            'KEY `permission_id` (`permission_id`)'
        ), 'ENGINE=InnoDB DEFAULT CHARSET=utf8');
        $this->addForeignKey(
            'user_permission_ibfk_2',
            'user_permission',
            'permission_id',
            'permission',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'user_permission_ibfk_1',
            'user_permission',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->execute(
            'ALTER TABLE  `system_module` ADD  `permission_id` INT UNSIGNED NULL DEFAULT NULL AFTER  `installation` ,
            ADD INDEX (  `permission_id` )');
        $this->addForeignKey(
            'system_module_ibfk_1',
            'system_module',
            'permission_id',
            'permission',
            'id',
            'SET NULL',
            'CASCADE'
        );
        $this->insert('permission', array('id' => 1, 'constant' => 'PERMISSION_ROOT', 'title' => 'Супер Администратор', 'group' => 1, 'position' => 0));
        $this->insert('permission', array('id' => 2, 'constant' => 'PERMISSION_INVITE', 'title' => 'Добавление пользователей', 'group' => 1, 'position' => 1));
        $this->insert('permission', array('id' => 3, 'constant' => 'PERMISSION_PROJECT_MANAGE', 'title' => 'Редактировать проекты', 'group' => 2, 'position' => 1));
        $this->insert('permission', array('id' => 4, 'constant' => 'PERMISSION_GROUP_MANAGE', 'title' => 'Редактировать группы пользователей', 'group' => 1, 'position' => 2));
        $this->insert('permission', array('id' => 5, 'constant' => 'PERMISSION_PROJECT_VIEW', 'title' => 'Просматривать проекты', 'group' => 2, 'position' => 0));
        $this->insert('permission', array('id' => 6, 'constant' => 'PERMISSION_TICKET_VIEW', 'title' => 'Просматривать тикеты', 'group' => 3, 'position' => 0));
        $this->insert('permission', array('id' => 7, 'constant' => 'PERMISSION_TICKET_MANAGE', 'title' => 'Редактировать тикеты', 'group' => 3, 'position' => 1));
        $this->insert('permission', array('id' => 8, 'constant' => 'PERMISSION_WIKI_VIEW', 'title' => 'Просматривать Wiki', 'group' => 4, 'position' => 0));
        $this->insert('permission', array('id' => 9, 'constant' => 'PERMISSION_WIKI_MANAGE', 'title' => 'Редактировать Wiki', 'group' => 4, 'position' => 1));
        $this->insert('permission', array('id' => 11, 'constant' => 'PERMISSION_ERROR_VIEW', 'title' => 'Просмотр ошибок', 'group' => 5, 'position' => 0));
        $this->insert('permission', array('id' => 12, 'constant' => 'PERMISSION_ERROR_MANAGE', 'title' => 'Редактирование ошибок', 'group' => 5, 'position' => 1));
        $this->insert('permission', array('id' => 13, 'constant' => 'PERMISSION_STATISTIC_VIEW', 'title' => 'Просмотр статистики', 'group' => 6 , 'position' => 0));
        $this->insert('permission', array('id' => 14, 'constant' => 'PERMISSION_STATISTIC_MANAGE', 'title' => 'Настройка статистики', 'group' => 6, 'position' => 1));
        $this->update('system_module', array('permission_id' => 5), 'id = 2');
        $this->update('system_module', array('permission_id' => 6), 'id = 7');
        $this->update('system_module', array('permission_id' => 8), 'id = 8');
        $this->update('system_module', array('permission_id' => 3), 'id = 10');
        $this->update('system_module', array('permission_id' => 6), 'id = 11');
        $this->update('system_module', array('permission_id' => 6), 'id = 13');
        $this->update('system_module', array('permission_id' => 6), 'id = 14');
        $this->update('system_module', array('permission_id' => 13), 'id = 15');
        $this->update('system_module', array('permission_id' => 11), 'id = 16');
	}

	public function down()
	{
        $this->dropForeignKey('system_module_ibfk_1','system_module');
        $this->dropColumn('system_module','permission_id');
        $this->dropTable('user_permission');
        $this->dropTable('permission');

	}


}