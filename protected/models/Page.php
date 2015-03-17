<?php
/**
 * Class Page
 * @property Label[] $labels
 */
class Page extends CPage {


    public function behaviors() {
        return array_merge(
            parent::behaviors(),
            array(
                'fillCreateColumn' => array(
                    'class' => 'FillCreateColumnBehavior'
                )
            )
        );
    }

    public function _extendedRelations() {
        return array(
            'labels' => array(self::MANY_MANY, 'Label', 'page_label(page_id,label_id)'),
            'messages' => array(self::MANY_MANY, 'Message', 'page_message(page_id,message_id)'),
        );
    }

    public function getCssClass() {
        if ($this->level->weight < 10) {
            return 'low';
        } else if ($this->level->weight < 20) {
            return 'normal';
        } else if ($this->level->weight < 30) {
            return 'high';
        } else if ($this->level->weight < 30) {
            return 'urgent';
        }
        return 'immediately';
    }

    protected function instantiate($attributes)
    {
        switch ($attributes['page_type_id']) {
            case PAGE_TYPE_NOTES:
                return new NotePage(null);
            case PAGE_TYPE_WIKI:
                return new WikiPage(null);
            case PAGE_TYPE_RELEASE:
                return new ReleasePage(null);
            case PAGE_TYPE_TICKETS:
                return new TicketPage(null);
        }
        throw new Exception('Undefined page type: '.$attributes['page_type_id']);
    }

    public function getTitle() {
        return $this->title;
    }
    /**
     * @return Page
     */
    public function getTopPage() {
        $parent = $this;
        while ($parent->parentPage) {
            $parent = $parent->parentPage;
        }
        return $parent;
    }

    public function getParentsList($invert = true) {
        $parent = $this->parentPage;
        $result = array();
        while ($parent) {
            $result[] = $parent;
            $parent = $parent->parentPage;
        }
        if ($invert) {
            return array_reverse($result);
        }
        return $result;
    }

    public function getBodyAsHtml() {
        return Yii::app()->user->getEditor()->parse($this->body);
    }

    public function getCommentsProvider() {
        $criteria = new CDbCriteria();
        $criteria->with = array(
            'pageMessage'=>array('select' => false)
        );
        $criteria->compare('pageMessage.page_id',$this->id);
        $criteria->order = 't.created DESC';
        return new CActiveDataProvider('Message',array(
            'criteria' => $criteria,
            'pagination' => array('pageSize'=>40)
        ));
    }
}