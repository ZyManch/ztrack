<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 14.03.2015
 * Time: 23:14
 */
class LastReleaseWidgetModule extends AbstractWidgetModule {

    /** @var  SearchPage */
    protected $_searchModel;

    /** @var  Page */
    protected $_lastRelease;

    public function getTitle() {
        return 'Текущий '.$this->getLastRelease()->getTitle();
    }


    public function configure($config) {
        if (!isset($config['project_id']) || !$config['project_id']) {
            throw new Exception('project id is missed in widget');
        }
        $projectId = $config['project_id'];
        $this->_lastRelease = $this->_getLastRelease($projectId);
        $this->_searchModel = $this->_getSearchModel($projectId);
    }

    public function getLastRelease() {
        return $this->_lastRelease;
    }

    protected function _getLastRelease($projectId) {
        $criteria = new CDbCriteria();
        $criteria->compare('page_type_id',PAGE_TYPE_RELEASE);
        $criteria->compare('project_id',$projectId);
        $criteria->order = 'title ASC';
        return ReleasePage::model()->find($criteria);
    }

    public function convertPostToConfigure($postData) {
        return $postData;
    }

    protected function _renderWidget() {
        try {
            Yii::app()->controller->renderPartial(
                '//modules/widget/lastRelease/_view',
                array(
                    'search_model' => $this->_searchModel,
                    'last_release' => $this->_lastRelease
                )
            );
        } catch (Exception $e) {
            ob_end_clean();
            throw $e;
        }
    }


    protected function  _getSearchModel($projectId) {
        if (!$this->_lastRelease) {
            return null;
        }
        $search = new SearchPage();
        $search->project_id = $projectId;
        $search->parent_page_id = $this->_lastRelease->id;
        return $search;
    }

}