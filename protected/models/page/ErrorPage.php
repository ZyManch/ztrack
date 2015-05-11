<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 13.03.2015
 * Time: 23:56
 */
class ErrorPage extends Page {

    public function getTitle() {
        return 'Error: '.($this->pageErrors ? $this->pageErrors[0]->error->title : 'undefined');
    }

    public function rules()	{
        return array(
            array('author_user_id, page_type_id', 'required'),
            array('body', 'safe'),
            array('title', 'match','allowEmpty'=>false,'pattern'=>'/^[a-zA-Z0-9\.]+$/',
                'message'=>'Release name must contain only latin chars,numbers and dot.'),
            array('progress, parent_page_id, author_user_id, page_type_id, project_id, level_id', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max'=>128),
            array('status', 'length', 'max'=>7),

        );
    }
    public function __toString() {
        return CHtml::link(
            CHtml::encode($this->getTitle()),
            array(
                'project/view',
                'id'=>$this->project_id,
                'module'=>'tickets',
                'action'=>'view',
                'ticket_id'=>$this->id
            )
        );
    }
}