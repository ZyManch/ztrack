<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 09.03.2015
 * Time: 12:00
 */
class TicketsProjectModule extends AbstractProjectModule {

    public function getModuleName() {
        return 'tickets';
    }

    public function getTabs() {
        return array(
            array(
                'label' => 'Tickets',
            )
        );
    }

    public function accessRules() {
        return  array_merge(
            array(
                array('allow',
                    'actions' => array('index','view','assign','update','changeStatus','create'),
                    'users'=>array('*'),
                )
            ),
            parent::accessRules()
        );
    }

    public function actionIndex() {
        $project = $this->_getProject();
        $ticketCount = $project->pagesCount;
        if (!$ticketCount) {
            $this->redirect(array(
                'action'=>'create'
            ));
        }
        $this->renderPartial(
            '_index',
            array(
                'widgets' => $this->_getAvailableWidgets(),
            )
        );
    }

    public function actionView() {
        $model = $this->_getCurrentTicket();
        $this->renderPartial(
            '_view',
            array(
                'model' => $model,
            )
        );
    }

    public function actionAssign() {
        $model = $this->_getCurrentTicket();
        try {
            $userId = Yii::app()->request->getParam('user_id');
            if (!$userId) {
                throw new Exception('User not found');
            }
            $user = User::model()->findByAttributes(array(
                'id' => $userId,
                'company_id' => Yii::app()->user->getUser()->company_id
            ));
            if (!$user) {
                throw new Exception('User not found');
            }
            $link = $model->getOrCreateUserPage($user->id);
            if ($model->assignedUserPage) {
                $model->assignedUserPage->is_assigned = UserPage::IS_NOT_ASSIGNED;
                $model->assignedUserPage->save(false);
            }
            $link->is_assigned = UserPage::IS_ASSIGNED;
            $link->save(false);
            if (!$model->save()) {
                throw new Exception($model->getErrorsAsText());
            }
        } catch (Exception $e) {
            Yii::app()->user->setFlash('error',$e->getMessage());
        }
        $this->redirect(array(
            'action'=>'view',
            'ticket_id'=>$model->id
        ));
    }

    public function actionChangeStatus() {
        $model = $this->_getCurrentTicket();
        $status = Yii::app()->request->getParam('status');
        try {
            $model->status = $status;
            if ($status == ActiveRecord::STATUS_ACTIVE) {
                if ($model->progress==100) {
                    $model->progress = 99;
                }
            } else if ($status == ActiveRecord::STATUS_CLOSED) {
                if ($model->progress!=100) {
                    $model->progress = 100;
                }
            }

            if (!$model->save()) {
                throw new Exception('Error save model: '.$model->getErrorsAsText());
            }
        } catch (Exception $e) {
            Yii::app()->user->setFlash('error',$e->getMessage());
        }
        $this->redirect(array(
            'action' => 'view',
            'ticket_id' => $model->id
        ));
    }

    public function actionUpdate() {
        $model = $this->_getCurrentTicket();
        $className = get_class($model);
        if (isset($_POST[$className])) {
            $model->attributes = $_POST[$className];
            if (!$model->parent_page_id) {
                $model->parent_page_id = null;
            }
            if ($model->save()) {
                $this->redirect(array(
                    'action'=>'view',
                    'ticket_id'=>$model->id
                ));
            }
        }
        $this->renderPartial(
            '_update',
            array(
                'model' => $model,
            )
        );
    }

    public function actionCreate() {
        $model = new TicketPage('create');
        $projectId = Yii::app()->request->getParam('id');
        $model->attributes = Yii::app()->request->getParam('TicketPage',array());
        try {
            $parent = $this->_getCurrentTicket();
            $model->parent_page_id = $parent->id;
            $model->level_id = $parent->level_id;
        }catch (Exception $e) {
            $parent = null;
        }
        if (!$model->parent_page_id) {
            $model->parent_page_id = null;
        }
        $model->project_id = $projectId;
        $model->author_user_id = Yii::app()->user->id;
        $model->page_type_id = PAGE_TYPE_TICKETS;

        if (Yii::app()->request->isPostRequest && $model->save()) {
            $this->redirect(array(
                'action'=>'view',
                'ticket_id'=>$model->id
            ));
        }
        $this->renderPartial(
            '_create',
            array(
                'model' => $model,
            )
        );
    }

    protected function _getAvailableWidgets() {
        $result = array();
        $lastReleaseWidget = $this->_getLastReleaseWidget();
        if ($lastReleaseWidget->getLastRelease()) {
            $result[] = array(
                'label' => 'Last release',
                'name' => 'release',
                'widget' => $lastReleaseWidget,
            );
        }
        $result[] = array(
            'label' => 'Assigned to me',
            'name' => 'assigned_to_me',
            'widget' => $this->_getAssignedToMeTicketsWidget(),
        );
        $result[] = array(
            'label' => 'Created by me',
            'name' => 'created_by_me',
            'widget' => $this->_getCreatedByMyTicketsWidget(),
        );
        $result[] = array(
            'label' => 'All tickets',
            'name' => 'all',
            'widget' => $this->_getAllTicketsWidget(),
        );
        return $result;
    }

    /**
     * @return LastReleaseWidgetModule
     * @throws Exception
     */
    protected function _getLastReleaseWidget() {
        $projectId = Yii::app()->request->getParam('id');
        $widget = new LastReleaseWidgetModule();
        $widget->configure(array('project_id'=>$projectId));
        return $widget;
    }

    protected function  _getAllTicketsWidget() {
        $projectId = Yii::app()->request->getParam('id');
        $widget = new TicketsWidgetModule();
        $widget->configure(array('project_id' => $projectId));
        return $widget;
    }

    protected function _getAssignedToMeTicketsWidget() {
        $widget = new TicketsWidgetModule();
        $widget->configure(array(
            'project_id' => Yii::app()->request->getParam('id'),
            'assign_user_id' => Yii::app()->user->id,
            'status' => array(ActiveRecord::STATUS_ACTIVE)
        ));
        return $widget;
    }

    protected function _getCreatedByMyTicketsWidget() {
        $widget = new TicketsWidgetModule();
        $widget->configure(array(
            'project_id' => Yii::app()->request->getParam('id'),
            'author_user_id' => Yii::app()->user->id
        ));
        return $widget;
    }

    protected function _getCurrentTicket() {
        $ticketId = Yii::app()->request->getParam('ticket_id');
        if (!$ticketId) {
            throw new Exception('Missed ticket id');
        }
        $ticket = TicketPage::model()->resetScope()->findByAttributes(array(
            'id'=>$ticketId,
            'project_id'=>Yii::app()->request->getParam('id')
        ));
        if (!$ticket) {
            throw new Exception('Ticket not found');
        }
        return $ticket;
    }
}