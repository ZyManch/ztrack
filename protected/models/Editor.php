<?php
class Editor extends CEditor {

    const DEFAULT_EDITOR_ID = 1;

    protected function instantiate($attributes) {
        $class = ucfirst($attributes['name']).'Editor';
        $model=new $class(null);
        return $model;
    }

}