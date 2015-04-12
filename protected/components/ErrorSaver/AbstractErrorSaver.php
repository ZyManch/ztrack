<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.04.2015
 * Time: 17:11
 */
abstract class AbstractErrorSaver {


    abstract function save($error);


    /**
     * @param $hash
     * @return Token
     * @throws Exception
     */
    protected function _getToken($hash) {
        if (!$hash) {
            throw new Exception('Token hash is missed');
        }
        $token = Token::model()->findByAttributes(array('hash'=>$hash));
        if (!$token) {
            throw new Exception('Token hash is wrong');
        }
        return $token;

    }

    protected function _findIdentical(Project $project,  Level $level, $environment, $title, $traceFile, $traceLine) {


        $hash = md5(implode('|',array(
            $title,
            $level->id,
            $traceFile,
            $traceLine,
            $project->id,
            $environment
        )));

        $error = Error::model()->findByAttributes(array(
            'hash' => $hash,
        ));
        if (!$error) {
            $error = new Error();
            $error->attributes = array(
                'title' => $title,
                'level_id' => $level->id,
                'project_id' => $project->id,
                'hash' => $hash,
                'trace_file' => $traceFile ? $traceFile : null,
                'trace_line' => $traceLine ? $traceLine : null,
            );
            $error->save(false);
        }
        return $error;
    }

    protected function _getLevel($levelName,$companyId) {
        if (!$levelName) {
            $levelName = 'error';
        }
        $criteria = new CDbCriteria();
        $criteria->compare('title',$levelName);
        $criteria->addCondition('(company_id is null or company_id=:company)');
        $criteria->params[':company'] = $companyId;
        $level = Level::model()->find($criteria);
        if (!$level) {
            $level = new Level();
            $level->attributes = array(
                'type'=>'Exception',
                'title' => $levelName,
                'company_id' => $companyId,
                'weight' => 50
            );
            $level->save(false);
        }
        return $level;
    }
}