<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 01.07.2015
 * Time: 7:15
 */
class SqlForm extends CFormModel {


    public $database;
    public $table;
    public $sql;

    public function rules() {
        return array(
            array('database, table, sql', 'required'),
        );
    }
}