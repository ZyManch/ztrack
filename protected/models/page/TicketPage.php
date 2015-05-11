<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 13.03.2015
 * Time: 23:56
 */
class TicketPage extends Page {

    public function rules()	{
        return array(
            array('author_user_id, page_type_id,title,body', 'required'),
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