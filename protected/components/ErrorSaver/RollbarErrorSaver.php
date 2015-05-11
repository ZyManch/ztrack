<?php
/**
 * Created by PhpStorm.
 * User: Helen
 * Date: 12.04.2015
 * Time: 10:22
 */
class RollbarErrorSaver extends AbstractErrorSaver {


    public function save($error) {
        $content = CJSON::decode($error);
        $token = $this->_getToken($content['access_token']);
        $companyId = $token->project->company_id;
        $data = $content['data'];
        $level = $this->_getLevel(
            $this->_extractParam($data,'level','error'),
            $companyId
        );
        $fileNameAndLine = $this->_getFileNameAndLine($data);
        $branch = $this->_getBranch(
            $companyId,
            $this->_extractParam($data,'server.branch','unknown')
        );
        $error = $this->_findIdentical(
            $token->project,
            $level,
            $branch,
            $this->_extractParam($data,'environment','unknown'),
            $this->_extractParam($data,'title','unknown'),
            $fileNameAndLine[0],
            $fileNameAndLine[1]
        );
        $request = $this->_saveRequest($error,$data);
        $this->_saveContext($request,$data);
        $this->_saveTrace($request, $data);
    }

    protected function _saveRequest(Error $error, $data) {
        $request = new Request();
        $request->error_id = $error->id;

        $browser = $this->_extractParam(
            $data,
            'client.javascript.browser'
        );
        $detector = new DeviceDetector\DeviceDetector($browser);
        $detector->discardBotInformation();
        $detector->parse();
        $ip = $this->_extractParam($data,'request.user_ip','0.0.0.0');
        $browser = $this->_getBrowser($detector);
        $os = $this->_getOs($detector);
        $request->setAttributes(
            $this->_getUserAttributes($ip, $browser, $os)
        );

        $server = $this->_getServer(
            $error->project->company_id,
            $this->_extractParam($data,'server.host','unknown')
        );
        $request->setAttributes(
            $this->_getServerAttributes($server)
        );

        $method = $this->_getMethod(
            $this->_extractParam($data,'request.method','GET')
        );
        $url = $this->_getUrl(
            $this->_extractParam($data,'request.url','')
        );
        $referer = $this->_getUrl(
            $this->_extractParam($data,'request.headers.Referer')
        );
        $request->setAttributes(
            $this->_getRequestAttributes($method,$url,$referer)
        );
        $request->save(false);
        return $request;
    }

    protected function _saveContext(Request $request, $data) {
        if (isset($data['person'])) {
            foreach ($data['person'] as $key => $value) {
                $this->_addContext($request, 'user_'.$key,$value);
            }
        }
        if (isset($data['request']['params']) && $data['request']['params']) {
            $this->_addContext($request, 'params',json_encode($data['request']['params']));
        }
        if (isset($data['request']['GET']) && $data['request']['GET']) {
            $this->_addContext($request, 'GET',json_encode($data['request']['GET']));
        }
        if (isset($data['request']['POST']) && $data['request']['POST']) {
            $this->_addContext($request, 'POST',json_encode($data['request']['POST']));
        }
        if (isset($data['request']['body']) && $data['request']['body']) {
            $this->_addContext($request, 'BODY',json_encode($data['request']['body']));
        }

        if (isset($data['custom']) && is_array($data['custom'])) {
            foreach ($data['custom'] as $key => $value) {
                $this->_addContext($request, $key,$value);
            }
        }
    }

    protected function _getFileNameAndLine($data) {
        $body = $this->_extractParam($data,'body',array());
        if (isset($body['trace'])) {
            $frames = (isset($body['trace']['frames']) ? $body['trace']['frames'] : array());
            if (isset($frames[0])) {
                return array(
                    isset($frames[0]['filename']) ? $frames[0]['filename'] : null,
                    isset($frames[0]['lineno']) ? $frames[0]['lineno'] : null
                );
            }
        } else if (isset($body['message'])) {
            return array(null, null);
        } else if (isset($body['crash_report'])) {
            return array(null, null);
        }
        return array(null, null);
    }

    protected function _saveTrace(Request $request, $data) {
        $body = $this->_extractParam($data,'body',array());
        if (isset($body['trace'])) {
            $frames = (isset($body['trace']['frames']) ? $body['trace']['frames'] : array());
            $index = 0;
            foreach ($frames as $frame) {
                $trace = $this->_createTrace(
                    $request,
                    $this->_extractParam($frame,'filename'),
                    $this->_extractParam($frame,'lineno'),
                    $this->_extractParam($frame,'method'),
                    $index
                );
                $code = $this->_extractParam($frame,'code','');
                if ($code) {
                    $trace->addCodeText(
                        $code,
                        $this->_extractParam($frame,'context.pre',array()),
                        $this->_extractParam($frame,'context.post',array())
                    );
                }
                $trace->addArguments(
                    $this->_extractParam($frame,'args',array())
                );
                $index++;
            }
        }
    }
    
}