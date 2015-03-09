<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 17:33
 */
abstract class AbstractEditor extends Editor {

    abstract public function getHtmlEditor($model,$attribute,$htmlOptions = array());

    abstract public function parse($content);
}