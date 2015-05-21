<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 13.03.2015
 * Time: 23:56
 */
class NotePage extends Page {

    public function behaviors() {
        return array_merge(
            parent::behaviors(),
            array(
                'position' => array(
                    'class' => 'PositionBehaviour',
                    'parentProperty' => 'parentPage',
                    'parentPropertyId' => 'parent_page_id',
                    'parentChildProperty' => 'pages'
                )
            )
        );
    }
    public function _extendedRelations() {
        return array_merge(
            parent::_extendedRelations(),
            array(
                'pages' => array(self::HAS_MANY, 'Page', 'parent_page_id','order'=>'pages.position ASC'),
            )
        );
    }

    public function sort($notes, $skipIds = array()) {
        $sortIndex = 0;
        foreach ($notes as $noteParam) {
            $note = NotePage::model()->
                findByAttributes(array(
                    'page_type_id' => PAGE_TYPE_NOTES,
                    'author_user_id' => Yii::app()->user->id,
                    'id' => $noteParam['id']
                ));
            if (!$note) {
                throw new Exception('Note not found: '.json_encode($noteParam));
            }
            if (in_array($note->id, $skipIds)) {
                throw new Exception('Recursive saving');
            }
            $skipIds[] = $note->id;
            if ($note->parent_page_id != $this->id) {
                $note->parent_page_id = $this->id;
            }
            if ($note->position !== $sortIndex) {
                $note->position = $sortIndex;
            }
            $note->save(false);
            $sortIndex++;
            if (isset($noteParam['children'])) {
                $note->sort($noteParam['children'], $skipIds);
            }
        }
    }

}