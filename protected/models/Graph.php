<?php

/**
* This is the model class for table "graph".
*
* The followings are the available columns in table 'graph':
*/
class Graph extends CGraph {

    protected function instantiate($attributes) {
        $class = $attributes['name'].'Graph';
        if (!class_exists($class)) {
            throw new Exception('Undefined graph type: '.$attributes['name']);
        }
        return new $class(null);
    }

}
