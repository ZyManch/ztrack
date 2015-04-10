<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.04.2015
 * Time: 17:11
 */
class ErrorSaver {




    public function parseAsRollbarAndSave($error) {
        $content = json_decode($error, 1);
        $token = $this->_getToken($content['access_token']);

    }

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

    protected function _findIdentical($companyId, $title, $traceFile, $traceLine, $levelName) {
        if (!$levelName) {
            $levelName = 'error';
        }
        $criteria = new CDbCriteria();
        $criteria->compare('title',$levelName);
        $criteria->addCondition('(company_id is null or company_id=:company)');
        $criteria->params[':company'] = $companyId;
        $level = Level::model()->find($criteria);
        if ($level) {
            if ($traceFile && $traceLine) {
                $error = Error::model()->findByAttributes(array(
                    'title' => $title,
                    'trace_file' => $traceFile,
                    'trace_line' => $traceFile,
                ));
            } else {
                $criteria = new CDbCriteria();
                $criteria->compare('title',$title);
                $criteria->addCondition('trace_file is null and trace_line is null');
                $error = Error::model()->find($criteria);
            }
        } else {
            $error = null;
            $level = new Level();
            $level->attributes = array(
                'type'=>'Exception',
                'title' => $levelName,
                'company_id' => $companyId,
                'weight' => 50
            );
            $level->save(false);
        }
        if (!$error) {
            $error = new Error();
            $error->attributes = array(
                'title' => $title,
                'level_id' => $level->id,
                'trace_file' => $traceFile ? $traceFile : null,
                'trace_line' => $traceLine ? $traceLine : null,
            );
            $error->save(false);
        }
        return $error;
    }
}