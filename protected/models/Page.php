<?php
class Page extends CPage {

    public function getBodyAsHtml() {
        return $this->body;
        return Yii::app()->user->getEditor()->parse($this->body);
    }
}