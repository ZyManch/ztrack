<?php
/**
 * Class Page
 * @property Label[] $labels
 */
class Page extends CPage {

    public function _extendedRelations() {
        return array(
            'labels' => array(self::MANY_MANY, 'Label', 'page_label(page_id,label_id)'),
        );
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

    public function getBodyAsHtml() {
        return Yii::app()->user->getEditor()->parse($this->body);
    }
}