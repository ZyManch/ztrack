<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 */
class Request extends CRequest {


    public $count;

    public function behaviors() {
        return array_merge(
            parent::behaviors(),
            array(
                'country' => array(
                    'class' => 'CountryBehavior'
                )
            )
        );
    }

    public function rules()	{
        return array_merge(
            parent::rules(),
            array(array('count','numerical','integerOnly'=>true))
        );
    }

}
