<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.04.2015
 * Time: 14:58
 */
class GraylogErrorSaver extends AbstractErrorSaver {


    public function save($error) {
        $content = CJSON::decode($error);
        $token = $this->_getToken($content['_access_token']);
        $companyId = $token->project->company_id;
        $level = $this->_getLevel(
            $this->_extractParam($content,'level',3),
            $companyId
        );
        $fileNameAndLine = $this->_getFileNameAndLine($content);
        $branch = $this->_getBranch(
            $companyId,
            $this->_extractParam(
                $content,
                '_branch',
                $this->_extractParam($content,'_environment','unknown')
            )
        );
        $error = $this->_findIdentical(
            $token->project,
            $level,
            $branch,
            $this->_extractParam($content,'_environment','unknown'),
            $this->_extractParam($content,'short_message','unknown'),
            $fileNameAndLine[0],
            $fileNameAndLine[1]
        );
        $request = $this->_saveRequest($error,$content);
        $this->_saveContext($request,$content);
        $this->_saveTrace($request, $content);
    }

    protected function _saveContext(Request $request, $data) {
        $usedKeys = array(
            '_access_token',
            'level',
            '_branch',
            '_environment',
            'short_message',
            '_user_agent',
            '_remote_addr',
            'host',
            '_method',
            '_url',
            '_referer',
            'file',
            'line',
            'timestamp',
            '_timestamp',
            'version'
        );
        foreach ($data as $key => $value) {
            if (!in_array($key,$usedKeys)) {
                if (!$this->_addContext($request,$key,$value)) {
                    print sprintf("Error save context %s\n",$key);
                }
            }
        }
    }

    protected function _saveRequest(Error $error, $content) {
        $request = new Request();
        $request->error_id = $error->id;

        $browser = $this->_extractParam(
            $content,
            '_user_agent'
        );
        $detector = new DeviceDetector\DeviceDetector($browser);
        $detector->discardBotInformation();
        $detector->parse();
        $ip = $this->_extractParam($browser,'_remote_addr','0.0.0.0');
        $browser = $this->_getBrowser($detector);
        $os = $this->_getOs($detector);
        $request->setAttributes(
            $this->_getUserAttributes($ip, $browser, $os)
        );

        $server = $this->_getServer(
            $error->project->company_id,
            $this->_extractParam($content,'host','unknown')
        );
        $request->setAttributes(
            $this->_getServerAttributes($server)
        );

        $method = $this->_getMethod(
            $this->_extractParam($content,'_method','GET')
        );
        $url = $this->_getUrl(
            $this->_extractParam($content,'_url','')
        );
        $referer = $this->_getUrl(
            $this->_extractParam($content,'_referer')
        );
        $request->setAttributes(
            $this->_getRequestAttributes($method,$url,$referer)
        );
        $request->save(false);
        return $request;
    }

    protected function _saveTrace(Request $request, $content) {

    }

    protected function _getLevel($levelName,$companyId) {
        $levels = array(
            0 => 'emergency',
            1 => 'alert',
            2 => 'critical',
            3 => 'error',
            4 => 'warning',
            5 => 'notice',
            6 => 'info',
            7 => 'debug'
        );
        if (isset($levels[$levelName])) {
            $levelName = $levels[$levelName];
        }
        return parent::_getLevel($levelName,$companyId);
    }


    protected function _getFileNameAndLine($data) {
        $file = $this->_extractParam($data,'file');
        $line = $this->_extractParam($data,'line');
        return array($file, $line);
    }
}