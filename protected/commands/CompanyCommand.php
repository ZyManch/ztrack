<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 07.05.2015
 * Time: 17:10
 */
class CompanyCommand extends CConsoleCommand {

    public function actionCreate($company, $login, $email, $password) {
        $comp = new Company();
        $comp->editor_id = 2;
        $comp->title = $company;
        if (!$comp->save()) {
            echo $comp->getErrorsAsText();
            return;
        }
        printf("Company %s created \n",$company);
        $user = new User();
        $user->company_id = $comp->id;
        $user->username = $login;
        $user->email = $email;
        $user->setPassword($password);
        if (!$user->save()) {
            echo $user->getErrorsAsText();
            $comp->delete();
            return;
        }
        printf("User %s created \n",$login);
    }

}