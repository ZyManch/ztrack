<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 07.06.14
 * Time: 14:12
 */
class WebUser extends CWebUser {

    protected $_user;

    public $guestName='Гость';

    protected $_systemModules;

    /**
     * @return User
     */
    public function getUser() {
        if (!$this->id) {
            return null;
        }
        if ($this->_user) {
            return $this->_user;
        }
        $this->_user = User::model()->findByPk($this->id);
        if (!$this->_user) {
            $this->logout();
            Yii::app()->request->redirect('user/login');
        }
        return $this->_user;
    }

    /**
     * @return AbstractUserModule[]
     */
    public function getSystemModules() {
        if ($this->isGuest) {
            return $this->_getGuestSystemModules();
        } else {
            return $this->getUser()->getEnabledUserModules();
        }
    }

    /**
     * @return AbstractEditor
     */
    public function getEditor() {
        if ($this->isGuest) {
            return Editor::model()->findByPk(EDitor::DEFAULT_EDITOR_ID);
        }
        return $this->getUser()->company->editor;
    }

    protected function _getGuestSystemModules() {
        if (is_null($this->_systemModules)) {
            $this->_systemModules =  SystemModule::model()->with(
                array('guestSystemModules' => array('joinType'=>'INNER JOIN'))
            )->findAll(array('condition'=>'type="user"','order'=>'position DESC'));
        }
        return $this->_systemModules;
    }



}