<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 13.03.2015
 * Time: 23:56
 */
class TicketPage extends Page {

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