<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 */
class Os extends COs {

    public $count;

    public function rules()	{
        return array_merge(
            parent::rules(),
            array(array('count','numerical','integerOnly'=>true))
        );
    }

}
