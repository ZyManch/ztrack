<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 13.03.2015
 * Time: 23:56
 */
class ReleasePage extends Page {

    public function getTitle() {
        return 'Release '.$this->title;
    }

    public function rules()	{
        return array(
            array('author_user_id, page_type_id,title', 'required'),
            array('body', 'safe'),
            array('title', 'match','allowEmpty'=>false,'pattern'=>'/^[a-zA-Z0-9\.]+$/',
                'message'=>'Release name must contain only latin chars,numbers and dot.'),
            array('progress, parent_page_id, author_user_id, page_type_id, project_id, level_id', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max'=>128),
            array('status', 'length', 'max'=>7),

        );
    }

    public function _getUsers($isActive) {
        $criteria = new CDbCriteria();
        $criteria->select = array(
            '*'
        );
        if ($isActive) {
            $criteria->select[] = 'sum(if(page.status<>"Active",100,page.progress))/100 as count';
        } else {
            $criteria->select[] = 'count(page.id) as count';
        }
        $criteria->with = array(
            'assignedUserPages.page'
        );
        $criteria->compare('page.parent_page_id',$this->id);
        $criteria->group = 't.id';
        /** @var User $query */
        $query = User::model();
        if (!$isActive) {
            $query->resetScope();
        }
        return $query->findAll($criteria);
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