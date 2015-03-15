<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 14.03.2015
 * Time: 23:14
 */
class LastReleaseWidgetModule extends AbstractWidgetModule {

    /** @var  CActiveDataProvider */
    protected $_provider;

    /** @var  Page */
    protected $_lastRelease;


    public function configure($projectId) {
        $this->_lastRelease = $this->_getLastRelease($projectId);
        $this->_provider = $this->_getTicketsProvider($projectId);
    }

    public function getLastRelease() {
        return $this->_lastRelease;
    }

    public function haveItems() {
        return $this->_provider->itemCount > 0;
    }

    protected function _getLastRelease($projectId) {
        $criteria = new CDbCriteria();
        $criteria->compare('page_type_id',PAGE_TYPE_RELEASE);
        $criteria->compare('project_id',$projectId);
        $criteria->order = 'title ASC';
        return ReleasePage::model()->find($criteria);
    }



    public function draw() {
        Yii::app()->controller->renderPartial(
            '//modules/widget/_lastRelease',
            array(
                'provider' => $this->_provider
            )
        );
    }


    protected function  _getTicketsProvider($projectId) {
        if (!$this->_lastRelease) {
            return new CArrayDataProvider(array());
        }
        $criteria = new CDbCriteria();
        $criteria->compare('parent_page_id',$this->_lastRelease->id);
        $criteria->compare('project_id',$projectId);
        return new CActiveDataProvider('Page',array(
            'criteria'=>$criteria
        ));
    }

}