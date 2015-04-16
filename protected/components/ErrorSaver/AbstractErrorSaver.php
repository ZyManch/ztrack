<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.04.2015
 * Time: 17:11
 */
abstract class AbstractErrorSaver {

    protected $_detector;

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

    /**
     * @param Project $project
     * @param Level $level
     * @param Branch $branch
     * @param $environment
     * @param $title
     * @param $traceFile
     * @param $traceLine
     * @return Error
     */
    protected function _findIdentical(Project $project,  Level $level,
                                      Branch $branch, $environment,
                                      $title, $traceFile, $traceLine
    ) {


        $hash = md5(implode('|',array(
            $title,
            $level->id,
            $branch->id,
            $traceFile,
            $traceLine,
            $project->id,
            $environment
        )));

        $error = Error::model()->findByAttributes(array(
            'hash' => $hash,
        ));
        if ($error) {
            $error->total_count+=1;
            $error->save(false,array('total_count'));
        } else {
            $error = new Error();
            $error->attributes = array(
                'title' => $title,
                'level_id' => $level->id,
                'branch_id' => $branch->id,
                'project_id' => $project->id,
                'hash' => $hash,
                'total_count' => 1,
                'trace_file' => $traceFile ? $traceFile : null,
                'trace_line' => $traceLine ? $traceLine : null,
            );
            $error->save(false);
        }
        return $error;
    }

    /**
     * @param $levelName
     * @param $companyId
     * @return Level
     */
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

    /**
     * @param $companyId
     * @param $serverName
     * @return Server|null
     */
    protected function _getServer($companyId, $serverName) {
        $attributes = array(
            'company_id' => $companyId,
            'title' => $serverName
        );
        $server = Server::model()->findByAttributes($attributes);
        if (!$server) {
            $server = new Server();
            $server->setAttributes($attributes);
            $server->save(false);
        }
        return $server;
    }

    protected function _getUserAttributes($ip = null, Browser $browser = null, Os $os = null) {
        return array(
            'browser_id' => $browser ? $browser->id: null,
            'os_id' => $os ? $os->id : null,
            'user_ip' => $ip ? sprintf("%u", ip2long($ip)) : null
        );
    }

    protected function _getRequestAttributes(Method $method,Url $url,Url $referer = null) {
        return array(
            'method_id' =>$method->id,
            'url_id' => $url->id,
            'referer_url_id' => $referer ? $referer->id : null
        );
    }

    protected function _getServerAttributes(Server $server) {
        return array(
            'server_id' => $server->id
        );
    }

    protected function _getBranch($companyId, $branchName) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.title',$branchName);
        $criteria->addCondition('(t.company_id is null or t.company_id = :company)');
        $criteria->params[':company'] = $companyId;
        $branch = Branch::model()->find($criteria);
        if (!$branch) {
            $branch = new Branch();
            $branch->setAttributes(array(
                'title' => $branchName,
                'company_id' => $companyId,
            ));
            $branch->save(false);
        }
        return $branch;
    }

    /**
     * @param \DeviceDetector\DeviceDetector $detector
     * @return Os
     */
    protected function _getOs(DeviceDetector\DeviceDetector $detector) {
        $name = $detector->getOs('name');
        $version = $detector->getOs('version');
        $isMobile = $detector->isMobile();
        $attributes = array(
            'os' => $name,
            'version'=>$version,
            'is_device'=>$isMobile?'Yes':'No'
        );
        $os = Os::model()->findByAttributes($attributes);
        if (!$os) {
            $os = new Os();
            $os->setAttributes($attributes);
            $os->save(false);
        }
        return $os;

    }

    /**
     * @param \DeviceDetector\DeviceDetector $detector
     * @return Browser
     */
    protected function _getBrowser(DeviceDetector\DeviceDetector $detector) {
        $name = $detector->getClient('name');
        $version = $detector->getClient('version');
        $attributes = array(
            'browser' => $name,
            'version'=>$version
        );
        $browser = Browser::model()->findByAttributes($attributes);
        if (!$browser) {
            $browser = new Browser();
            $browser->setAttributes($attributes);
            $browser->save(false);
        }
        return $browser;
    }

    /**
     * @param $name
     * @return Method
     */
    protected function _getMethod($name) {
        $name = strtoupper($name);
        if (!$name) {
            $name= 'GET';
        }
        $attributes = array(
            'title' => $name
        );
        $method =  Method::model()->findByAttributes($attributes);
        if (!$method) {
            $method = new Method();
            $method->setAttributes($attributes);
            $method->save(false);
        }
        return $method;
    }

    /**
     * @param $url
     * @return Url
     */
    protected function _getUrl($url) {
        $parts = parse_url($url);
        $attributes = array(
            'protocol' => $parts['scheme'],
            'domain' => $parts['host'],
            'url' => $parts['path'].($parts['query']?'?'.$parts['query']:'')
        );
        $url = Url::model()->findByAttributes($attributes);
        if (!$url) {
            $url = new Url;
            $url->setAttributes($attributes);
            $url->save(false);
        }
        return $url;
    }

    protected function _createTrace(Request $request, $filename,$lineno, $method, $position) {
        $trace = new Trace();
        $trace->setAttributes(array(
            'request_id' => $request->id,
            'filename' => $filename,
            'line' => $lineno,
            'method' => $method,
            'position' => $position
        ));
        $trace->save(false);
        return $trace;
    }


    protected function _extractParam($data, $keys, $default = null) {
        if (!is_array($keys)) {
            $keys = explode('.', $keys);
        }
        foreach ($keys as $key) {
            if (!isset($data[$key])) {
                return $default;
            }
            $data = $data[$key];
        }
        return $data;
    }

    protected function _addContext(Request $request, $key, $value) {
        $context = new RequestData();
        $context->type = $key;
        $context->request_id = $request->id;
        $context->data = $value;
        return $context->save(false);
    }


}