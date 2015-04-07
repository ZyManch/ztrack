<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 13.03.2015
 * Time: 23:56
 */
class ReleasePage extends Page {

    public function getTitle() {
        return 'Релиз '.$this->title;
    }

    public function rules()	{
        return array(
            array('author_user_id, page_type_id,title', 'required'),
            array('body', 'safe'),
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