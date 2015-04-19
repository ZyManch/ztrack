<?php

/**
* This is the model class for table "graph".
*
* The followings are the available columns in table 'graph':
*/
class Graph extends CGraph {

    static $_graphs = array();

    protected function instantiate($attributes) {
        $class = $attributes['name'].'Graph';
        if (!class_exists($class)) {
            throw new Exception('Undefined graph type: '.$attributes['name']);
        }
        return new $class(null);
    }

    /**
     * @param mixed $pk
     * @param string $condition
     * @param array $params
     * @return GraphAbstract
     */
    public function findByPk($pk,$condition='',$params=array()) {
        if(!isset(self::$_graphs[$pk])){
            self::$_graphs[$pk] = parent::findByPk($pk,$condition,$params);
        }
        return self::$_graphs[$pk];
    }

}
