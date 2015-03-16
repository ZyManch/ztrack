<?php

class m150316_112351_temporary extends EDbMigration
{
	public function up() {

        $this->insert('company',array(
            'id' => 1,
            'title' => 'MyCompany',
            'editor_id' => 2,
        ));
        $this->insert('user', array(
            'id' => 1,
            'company_id' => 1,
            'login' => 'zymanch',
            'email' => 'zymanch@gmail.com',
            'password' => '3268d93b93f909370e16a3f414787013'
        ));

        $this->insert('access', array(
            'id' => 1,
            'title' => 'admin',
            'access' => 'read,create,update,exception',
        ));
        $this->insert('access', array(
            'id' => 2,
            'company_id' => 1,
            'title' => 'Full access',
            'access' => 'read,create,update,exception',
        ));

        $this->insert('branch', array(
            'id' => 1,
            'title' => 'master'
        ));

        $this->insert('project', array(
            'id' =>1,
            'title' => 'GTFlix',
        ));
        $this->insert('project', array(
            'id' =>2,
            'title' => 'Gfpass',
            'parent_id' => 1,
        ));
        $this->insert('project', array(
            'id' =>3,
            'title' => 'LegalVideo',
            'parent_id' => 1,
        ));



        $this->insert('group', array(
            'id' => 1,
            'company_id' => 1,
            'title' => 'Test group'
        ));

        $this->insert('group_access', array(
            'id' => 1,
            'group_id' => 1,
            'access_id' => 2,
            'project_id' => 3,
        ));
        $this->insert('label', array(
            'id' => 1,
            'company_id' => 1,
            'title' => 'label',
            'color' => '1ab394'
        ));

        $this->insert('page', array(
            'id' => 9,
            'author_user_id' => 1,
            'page_type_id' => 4,
            'project_id' => 2,
            'title' => '1.0',
            'body' => '',
            'progress' => 0,
        ));

        $this->insert('page', array(
            'id' => 2,
            'parent_page_id' => 9,
            'author_user_id' => 1,
            'assign_user_id' => 1,
            'page_type_id' => 1,
            'project_id' => 2,
            'title' => 'Тикет 1',
            'body' => 'Описание тикета',
            'progress' => 0,
            'level_id' =>8,
        ));
        $this->insert('page', array(
            'id' => 3,
            'author_user_id' => 1,
            'page_type_id' => 2,
            'project_id' => 2,
            'title' => 'Wiki page',
            'body' => 'Info',
            'progress' => 0,
        ));
        $this->insert('page', array(
            'id' => 4,
            'author_user_id' => 1,
            'page_type_id' => 2,
            'body' => '<p>asdasdsad</p>',
            'progress' => 0,
        ));
        $this->insert('page', array(
            'id' => 5,
            'author_user_id' => 1,
            'page_type_id' =>2 ,
            'project_id' => 2,
            'url' => '',
            'title' => '123',
            'body' => '== Heading ==\r\n\r\n=== Subheading ===\r\n\r\n==== Subsubheading ====\r\n\r\nBold-italic \r\n\r\nBold \r\n\r\nItalic\r\n\r\n---- \r\n\r\n<a href="asdas">asdad</a>\r\n: Indentation\r\n\r\n:: Subindentation\r\n\r\n* Unordered list \r\n** Unordered list \r\n** Unordered list \r\n# Ordered list \r\n## Ordered list \r\n## Ordered list \r\n\r\n[[file:http://example.com/image.jpg title]]\r\n\r\n\r\nтекст http://example.com текст\r\n\r\n\r\nфыв\r\n\r\n"Example Link":http://example.com\r\n\r\n\r\nфыв\r\n[mylink]',
            'progress' => 0,
        ));
        $this->insert('page', array(
            'id' => 6,
            'author_user_id' => 1,
            'page_type_id' => 2,
            'project_id' => 2,
            'url' => 'My link',
            'title' => 'info',
            'body' => '',
            'progress' => 0,
        ));
        $this->insert('page', array(
            'id' => 7,
            'author_user_id' => 1,
            'page_type_id' => 3,
            'title' => 'note 1',
            'body' => 'asdasdasd',
            'progress' => 0,
        ));
        $this->insert('page', array(
            'id' => 8,
            'parent_page_id' => 7,
            'author_user_id' => 1,
            'page_type_id' => 3,
            'title' => 'note 2',
            'body' => 'asdsadasd\r\n\r\n\r\nasdasd *asdsada* asdsadsa',
            'progress' => 0,
        ));


        $this->insert('page_label', array(
            'id' => 1,
            'page_id' => 7,
            'label_id' => 1,
        ));


        $this->insert('project_system_module', array(
            'id' => 1,
            'project_id' => 2,
            'system_module_id' => 7,
        ));
        $this->insert('project_system_module', array(
            'id' => 3,
            'project_id' => 2,
            'system_module_id' => 8,
        ));
        $this->insert('project_system_module', array(
            'id' => 4,
            'project_id' => 2,
            'system_module_id' => 10,
        ));
        $this->insert('project_system_module', array(
            'id' => 5,
            'project_id' => 3,
            'system_module_id' => 10,
        ));
        $this->insert('project_system_module', array(
            'id' => 6,
            'project_id' => 3,
            'system_module_id' => 7,
        ));



        $this->insert('user_access', array(
            'id' => 1,
            'user_id' => 1,
            'access_id' => 1,
            'project_id' => 1
        ));
        $this->insert('user_access', array(
            'id' => 2,
            'user_id' => 1,
            'access_id' => 1,
            'project_id' => 2
        ));

        $this->insert('user_group', array(
            'id' => 1,
            'user_id' => 1,
            'group_id' => 1
        ));

        $this->insert('user_system_module', array(
            'id' => 1,
            'user_id' => 1,
            'system_module_id' => 1,
        ));
        $this->insert('user_system_module', array(
            'id' => 2,
            'user_id' => 1,
            'system_module_id' => 2,
        ));
        $this->insert('user_system_module', array(
            'id' => 3,
            'user_id' => 1,
            'system_module_id' => 3,
        ));
        $this->insert('user_system_module', array(
            'id' => 4,
            'user_id' => 1,
            'system_module_id' => 4,
        ));
        $this->insert('user_system_module', array(
            'id' => 5,
            'user_id' => 1,
            'system_module_id' => 5,
        ));
        $this->insert('user_system_module', array(
            'id' => 6,
            'user_id' => 1,
            'system_module_id' => 6,
        ));
        $this->insert('user_system_module', array(
            'id' => 7,
            'user_id' => 1,
            'system_module_id' => 9,
        ));
	}

	public function down()
	{
		echo "m150316_112351_temporary does not support migration down.\n";
		return false;
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