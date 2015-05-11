<?php

/**
* This is the model class for table "messenger".
*
* The followings are the available columns in table 'messenger':
*/
class Messenger extends CMessenger {

    protected function instantiate($attributes) {
        $class = ucfirst($attributes['type']).'Messenger';
        $model=new $class(null);
        return $model;
    }

}
