<?php

/**
* This is the model class for table "page_history".
*
* The followings are the available columns in table 'page_history':
*/
class PageHistory extends CPageHistory {

    public function behaviors() {
        return array_merge(
            parent::behaviors(),
            array(
                'fillCreateColumn' => array(
                    'class' => 'FillCreateColumnBehavior'
                ),
            )
        );
    }

}
