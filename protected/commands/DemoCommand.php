<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 09.05.2015
 * Time: 21:24
 */
class DemoCommand extends CConsoleCommand {


    public function actionStat($company_id) {
        $db = Yii::app()->db;
        $transaction = $db->beginTransaction();
        try {
            $query = $transaction->connection->createCommand();
            $query->insert('statistic',array(
                'company_id' => $company_id,
                'name' => 'Выручка',
                'interval' => 'Day'
            ));
            $statId = $db->lastInsertID;
            $query->insert('statistic_data_string_value',array(
                'value' => 'Новые юзеры'
            ));
            $newUsersStatId = $db->lastInsertID;
            $query->insert('statistic_data_string_value',array(
                'value' => 'Старые юзеры'
            ));
            $oldUsersStatId = $db->lastInsertID;
            $query->insert('statistic_column',array(
                'statistic_id'=>$statId,
                'label' => 'Юзеров',
                'name' => 'users',
                'type' => 'Int'
            ));
            $usersColumnId = $db->lastInsertID;
            $query->insert('statistic_column',array(
                'statistic_id'=>$statId,
                'label' => 'Доход',
                'name' => 'income',
                'type' => 'Float'
            ));
            $incomeColumnId = $db->lastInsertID;
            $query->insert('statistic_column',array(
                'statistic_id'=>$statId,
                'label' => 'Дата',
                'name' => 'date',
                'type' => 'Date'
            ));
            $dateColumnId = $db->lastInsertID;
            $query->insert('statistic_column',array(
                'statistic_id'=>$statId,
                'label' => 'Тип',
                'name' => 'type',
                'type' => 'String'
            ));
            $typeColumnId = $db->lastInsertID;
            for ($i=-20;$i<=0;$i++) {
                $query->insert('statistic_point',array(
                    'statistic_id' => $statId
                ));
                $pointId1 = $db->lastInsertID;
                $query->insert('statistic_point',array(
                    'statistic_id' => $statId
                ));
                $pointId2 = $db->lastInsertID;
                $query->insert('statistic_data_date',array(
                    'statistic_column_id' => $dateColumnId,
                    'statistic_point_id' => $pointId1,
                    'value' => date('Y-m-d 00:00:00',strtotime('-'.$i.' days'))
                ));
                $query->insert('statistic_data_date',array(
                    'statistic_column_id' => $dateColumnId,
                    'statistic_point_id' => $pointId2,
                    'value' => date('Y-m-d 00:00:00',strtotime('-'.$i.' days'))
                ));
                $query->insert('statistic_data_int',array(
                    'statistic_column_id' => $usersColumnId,
                    'statistic_point_id' => $pointId1,
                    'value' => rand(10,40)
                ));
                $query->insert('statistic_data_int',array(
                    'statistic_column_id' => $usersColumnId,
                    'statistic_point_id' => $pointId2,
                    'value' => rand(10,40)
                ));
                $query->insert('statistic_data_float',array(
                    'statistic_column_id' => $usersColumnId,
                    'statistic_point_id' => $pointId1,
                    'value' => rand(100,400)/10
                ));
                $query->insert('statistic_data_float',array(
                    'statistic_column_id' => $usersColumnId,
                    'statistic_point_id' => $pointId2,
                    'value' => rand(100,400)/10
                ));
                $query->insert('statistic_data_string',array(
                    'statistic_column_id' => $usersColumnId,
                    'statistic_point_id' => $pointId1,
                    'statistic_data_string_value_id' => $newUsersStatId
                ));
                $query->insert('statistic_data_string',array(
                    'statistic_column_id' => $usersColumnId,
                    'statistic_point_id' => $pointId2,
                    'statistic_data_string_value_id' => $oldUsersStatId
                ));
            }
            $transaction->commit();
        }catch(Exception $e) {
            print 'Rollback: '.$e->getMessage();
            $transaction->rollback();
        }
    }

    public function actionCompany() {
        $db = Yii::app()->db;
        $transaction = $db->beginTransaction();
        try {
            $query = $transaction->connection->createCommand();

            $query->insert('company',array(
                'title' => 'MyCompany',
                'editor_id' => 2,
            ));
            $companyId = $db->lastInsertID;
            $query->insert('user', array(
                'company_id' => $companyId,
                'username' => 'zymanch',
                'email' => 'zymanch@gmail.com',
            ));
            $userId = $db->lastInsertID;;
            $query->insert('user_permission',array(
                'user_id' => $userId,
                'permission_id' => 1
            ));
            $query->update('user',array('password'=>md5($userId.'qwe123'.Yii::app()->params['salt'])),'id='.$userId);

            $query->insert('branch', array(
                'title' => 'master'
            ));

            $query->insert('project', array(
                'title' => 'GTFlix',
                'company_id' => $companyId
            ));
            $mainProjectId = $db->lastInsertID;;
            $query->insert('project', array(
                'title' => 'Gfpass',
                'parent_id' => $mainProjectId,
                'company_id' => $companyId
            ));
            $projectId = $db->lastInsertID;;
            $query->insert('project', array(
                'title' => 'LegalVideo',
                'parent_id' => $mainProjectId,
                'company_id' => $companyId
            ));



            $query->insert('group', array(
                'company_id' => $companyId,
                'title' => 'Test group'
            ));
            $groupId = $db->lastInsertID;;

            $query->insert('label', array(
                'company_id' => $companyId,
                'title' => 'label',
                'color' => '1ab394'
            ));
            $labelId= $db->lastInsertID;;

            $query->insert('page', array(
                'author_user_id' => $userId,
                'page_type_id' => 4,
                'project_id' => $projectId,
                'title' => '1.0',
                'body' => '',
                'progress' => 0,
            ));
            $releaseId = $db->lastInsertID;;

            $query->insert('page', array(
                'parent_page_id' => $releaseId,
                'author_user_id' => $userId,
                'page_type_id' => 1,
                'project_id' => $projectId,
                'title' => 'Тикет 1',
                'body' => 'Описание тикета',
                'progress' => 0,
                'level_id' =>8,
            ));
            $query->insert('page', array(
                'author_user_id' => $userId,
                'page_type_id' => 2,
                'project_id' => $projectId,
                'title' => 'Wiki page',
                'body' => 'Info',
                'progress' => 0,
            ));
            $query->insert('page', array(
                'author_user_id' => $userId,
                'page_type_id' => 2,
                'body' => '<p>asdasdsad</p>',
                'progress' => 0,
            ));
            $query->insert('page', array(
                'author_user_id' => $userId,
                'page_type_id' =>2 ,
                'project_id' => $projectId,
                'url' => '',
                'title' => '123',
                'body' => '== Heading ==\r\n\r\n=== Subheading ===\r\n\r\n==== Subsubheading ====\r\n\r\nBold-italic \r\n\r\nBold \r\n\r\nItalic\r\n\r\n---- \r\n\r\n<a href="asdas">asdad</a>\r\n: Indentation\r\n\r\n:: Subindentation\r\n\r\n* Unordered list \r\n** Unordered list \r\n** Unordered list \r\n# Ordered list \r\n## Ordered list \r\n## Ordered list \r\n\r\n[[file:http://example.com/image.jpg title]]\r\n\r\n\r\nтекст http://example.com текст\r\n\r\n\r\nфыв\r\n\r\n"Example Link":http://example.com\r\n\r\n\r\nфыв\r\n[mylink]',
                'progress' => 0,
            ));
            $query->insert('page', array(
                'author_user_id' => $userId,
                'page_type_id' => 2,
                'project_id' => $projectId,
                'url' => 'My link',
                'title' => 'info',
                'body' => '',
                'progress' => 0,
            ));
            $query->insert('page', array(
                'author_user_id' => $userId,
                'page_type_id' => 3,
                'title' => 'note 1',
                'body' => 'asdasdasd',
                'progress' => 0,
            ));
            $noteId = $db->lastInsertID;;
            $query->insert('page', array(
                'parent_page_id' => $noteId,
                'author_user_id' => $userId,
                'page_type_id' => 3,
                'title' => 'note 2',
                'body' => 'asdsadasd\r\n\r\n\r\nasdasd *asdsada* asdsadsa',
                'progress' => 0,
            ));


            $query->insert('page_label', array(
                'page_id' => $noteId,
                'label_id' => $labelId,
            ));


            $query->insert('project_system_module', array(
                'project_id' => $projectId,
                'system_module_id' => 7,
            ));
            $query->insert('project_system_module', array(
                'project_id' => $projectId,
                'system_module_id' => 8,
            ));
            $query->insert('project_system_module', array(
                'project_id' => $projectId,
                'system_module_id' => 10,
            ));




            $query->insert('user_group', array(
                'user_id' => $userId,
                'group_id' => $groupId
            ));

            $query->insert('user_system_module', array(
                'user_id' => $userId,
                'system_module_id' => 1,
            ));
            $query->insert('user_system_module', array(
                'user_id' => $userId,
                'system_module_id' => 2,
            ));
            $query->insert('user_system_module', array(
                'user_id' => $userId,
                'system_module_id' => 3,
            ));
            $query->insert('user_system_module', array(
                'user_id' => $userId,
                'system_module_id' => 4,
            ));
            $query->insert('user_system_module', array(
                'user_id' => $userId,
                'system_module_id' => 5,
            ));
            $query->insert('user_system_module', array(
                'user_id' => $userId,
                'system_module_id' => 6,
            ));
            $query->insert('user_system_module', array(
                'user_id' => $userId,
                'system_module_id' => 9,
            ));
            $transaction->commit();
        }catch(Exception $e) {
            print 'Rollback: '.$e->getMessage();
            $transaction->rollback();
        }
    }
}