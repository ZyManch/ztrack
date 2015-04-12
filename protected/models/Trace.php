<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 */
class Trace extends CTrace {


    public function addCodeText($code, $beforeCodes = array(), $afterCodes = array()) {
        $codes = array();
        $startBefore = $this->line - sizeof($beforeCodes);
        $line = 0;
        foreach ($beforeCodes as $beforeCode) {
            $codes[$startBefore+$line]=$beforeCode;
            $line++;
        }
        $codes[$this->line] = $code;
        $line = $this->line + 1;
        foreach ($afterCodes as $afterCode) {
            $codes[$line]=$afterCode;
            $line++;
        }
        foreach ($codes as $line => $code) {
            $traceCode = new TraceCode();
            $traceCode->setAttributes(array(
                'trace_id' => $this->id,
                'line' => $line,
                'code' => $code
            ));
            $traceCode->save(false);
        }
    }

    public function addArguments($arguments) {
        $position = 0;
        if (!is_array($arguments)) {
            $arguments = array();
        }
        foreach ($arguments as $key => $argument) {
            $traceArgument = new TraceArgument();
            $traceArgument->setAttributes(array(
                'trace_id' => $this->id,
                'name' => is_numeric($key) ? null : $key,
                'position' => $position,
                'value' => $argument
            ));
            $traceArgument->save(false);
            $position++;
        }
    }
}
