<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.04.2015
 * Time: 13:27
 */
class HighlightCode {

    const SKIPPED_LINE = -1;

    static $_isInit = false;

    protected $_language;
    protected $_codes = array();
    protected $_currentLine;

    public function __construct($language, $codes = array(), $currentLine = -1) {
        $this->_language = $language;
        $this->_currentLine = $currentLine;
        if ($currentLine == self::SKIPPED_LINE) {
            $currentLine = null;
        }
        if (is_array($codes)) {
            foreach ($codes as $index => $code) {
                if (is_object($code)) {
                    if (isset($code->line)) {
                        $index = $code->line;
                    }
                    $this->_codes[$index] = $code->code;
                } else {
                    $this->_codes[$index] = $code;
                }
            }
        } else {
            $this->_codes[$currentLine] = $codes;
        }
        $this->_init();
    }

    protected function _init() {
        $clientScript = Yii::app()->clientScript;
        $clientScript->registerScriptFile('/js/highlight.pack.js');
        $clientScript->registerCssFile('/css/highlight/default.css');
        $clientScript->registerScript(
            'highlight','$(".highlight").each(function (i,block) {
                hljs.highlightBlock(block);
            });'
        );
    }

    public function __toString() {
        try {
            $lines = array_keys($this->_codes);
            $firstLine = $lines[0];
            return
                CHtml::tag(
                    'div',
                    array('class'=> 'highlight'),
                    CHtml::tag(
                        'div',
                        array('class'=>'highlight-lines'),
                        implode('<br>',$lines)
                    ).
                    CHtml::tag(
                        'pre',
                        array('class'=>'highlight-code'),
                        CHtml::tag('div',array('class'=>$this->_language),CHtml::encode(implode("\n",$this->_codes)))
                    ).
                    (
                        $this->_currentLine != self::SKIPPED_LINE ?
                        CHtml::tag(
                            'div',
                            array('class'=>'highlight-active-line','style'=>'top:'.(7+($this->_currentLine-$firstLine)*18).'px'),
                            ''
                        ):
                        ''
                    )
                );
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}