<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 13.03.2015
 * Time: 23:56
 */
class WikiPage extends Page {

    public function getTitle() {
        if (trim($this->title)) {
            return $this->title;
        }
        return 'Unknown';
    }

}