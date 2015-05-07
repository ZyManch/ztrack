<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 07.05.2015
 * Time: 15:24
 */
class UserController extends Controller {

    public function actionProfile() {
        $model = Yii::app()->user->getUser();
        $this->render('profile',array('model'=>$model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}