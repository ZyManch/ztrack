<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 01.04.2015
 * Time: 15:15
 */
class HistoryController extends Controller {


    public function actionView($id) {
        $history = PageHistory::model()->findByPk($id);
        if (!$history) {
            throw new CHttpException(404,'Page not found');
        }
        $differ = new SebastianBergmann\Diff\Differ();
        $changes = $differ->diffToArray(
            $history->previousPageHistory ?
                $history->previousPageHistory->body :
                '',
            $history->body
        );
        $this->render('view',array(
            'history' => $history,
            'changes' => $changes
        ));
    }

}