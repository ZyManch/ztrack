<?php
class SystemModule extends CSystemModule {


    protected function instantiate($attributes)
    {
        $class = ucfirst($attributes['name']).ucfirst($attributes['type']).'Module';
        $model=new $class(null);
        return $model;
    }


}