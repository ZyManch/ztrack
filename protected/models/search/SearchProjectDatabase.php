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
class SearchProjectDatabase extends CProjectDatabase {

    public function __construct($scenario = 'search') {
        parent::__construct($scenario);
    }

    public function rules()	{
        return array(
            array('id, project_id, environment_id, hostname, port, username, password, database_list', 'safe', 'on'=>'search'),
        );
    }

    public function search() {

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('environment_id',$this->environment_id,true);
		$criteria->compare('hostname',$this->hostname,true);
		$criteria->compare('port',$this->port,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('database_list',$this->database_list,true);

        return new CActiveDataProvider('ProjectDatabase', array(
            'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>40)
        ));
    }

    public function save() {
        throw new Exception('Its search only model');
    }

}
