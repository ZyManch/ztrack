<?php
class Page extends CPage {

    public function getBodyAsHtml() {
        return Yii::app()->user->getEditor()->parse($this->body);
    }
}