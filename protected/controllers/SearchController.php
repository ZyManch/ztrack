<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 12.06.2015
 * Time: 15:54
 */
class SearchController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','wiki','error','ticket'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex($q) {
        $errorProvider = SearchRequest::searchByWords($q,PAGE_TYPE_WIKI);
        $ticketsProvider = SearchPage::searchByWords($q,PAGE_TYPE_TICKETS);
        $wikiProvider = SearchPage::searchByWords($q,PAGE_TYPE_WIKI);
        $foundInSectionCount = 0;
        $newActionName = null;
        if ($errorProvider->getTotalItemCount() > 0) {
            $foundInSectionCount++;
            $newActionName = 'error';
        }
        if ($ticketsProvider->getTotalItemCount() > 0) {
            $foundInSectionCount++;
            $newActionName = 'ticket';
        }
        if ($wikiProvider->getTotalItemCount() > 0) {
            $foundInSectionCount++;
            $newActionName = 'wiki';
        }
        if ($foundInSectionCount == 1) {
            $this->redirect(array($newActionName,'q'=>$q));
        }
        $this->render('index',array(
            'search_query' => $q,
            'foundErrors' => $errorProvider->getTotalItemCount(),
            'foundWiki' => $wikiProvider->getTotalItemCount(),
            'foundTicket' => $ticketsProvider->getTotalItemCount()
        ));
    }

    public function actionWiki($q) {
        $provider = SearchPage::searchByWords($q,PAGE_TYPE_WIKI);
        $this->render('wiki',array(
            'search_query' => $q,
            'dataProvider' => $provider
        ));
    }

    public function actionError($q) {
        $provider = SearchRequest::searchByWords($q);
        $this->render('error',array(
            'search_query' => $q,
            'dataProvider' => $provider
        ));
    }

    public function actionTicket($q) {
        $provider = SearchPage::searchByWords($q,PAGE_TYPE_TICKETS);
        $this->render('ticket',array(
            'search_query' => $q,
            'dataProvider' => $provider
        ));
    }
}