<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 10:25
 */
class NotesUserModule extends AbstractUserModule {

    public function getMainMenuItems() {
        return array(
            array(
                'label' => 'Notes',
                'url' => array('notes/index'),
                'icon'=>'book'
            )
        );
    }
}