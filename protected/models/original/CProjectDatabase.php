<?php

/**
* This is the model class for table "project_database".
*
* The followings are the available columns in table 'project_database':
    * @property string $id
    * @property string $project_id
    * @property string $environment_id
    * @property string $hostname
    * @property string $port
    * @property string $username
    * @property string $password
    * @property string $database_list
    *
    * The followings are the available model relations:
        * @property Project $project
        * @property Environment $environment
*/
class CProjectDatabase extends ActiveRecord {

    public function tableName()	{
        return 'project_database';
    }

    public function rules()	{
        return array(
            array('project_id, environment_id, hostname, username, password, database_list', 'required'),
			array('project_id, environment_id, port', 'length', 'max'=>10),
			array('hostname, username, password', 'length', 'max'=>128)        );
    }

    /**
    * @return array relational rules.
    */
    protected function _baseRelations()	{
        return array(
            'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
            'environment' => array(self::BELONGS_TO, 'Environment', 'environment_id'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'project_id' => 'Project',
            'environment_id' => 'Environment',
            'hostname' => 'Hostname',
            'port' => 'Port',
            'username' => 'Username',
            'password' => 'Password',
            'database_list' => 'Database List',
        );
    }


}
