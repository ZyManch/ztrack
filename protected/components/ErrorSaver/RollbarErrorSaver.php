<?php
/**
 * Created by PhpStorm.
 * User: елена
 * Date: 12.04.2015
 * Time: 10:22
 */
class RollbarErrorSaver extends AbstractErrorSaver {


    public function save($error) {
        $content = json_decode($error, 1);
        $token = $this->_getToken($content['access_token']);
        $level = $this->_getLevel($content['data']['level'],$token->project->company_id);
        $fileNameAndLine = $this->
        $error = $this->_findIdentical(
            $token->project,
            $level,
            $content['data']['environment'],
            $content['data']['title'],
        );
    }

    protected function _getFileNameAndLine($context) {

    }
    
}