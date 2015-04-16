<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 */
class RequestData extends CRequestData {


    public function getHumanReadableData() {
        $json = CJSON::decode($this->data);
        if ($json) {
            $jsonPretty = new Camspiers\JsonPretty\JsonPretty;
            $json = explode("\n",$jsonPretty->prettify($json,null,'   '));
            $highlight = new HighlightCode('json',$json);
            return $highlight;
        }


        return CHtml::tag('pre',array('class'=>'non-bordered'),CHtml::encode($this->data));

    }

}
