<?php

/**
* This is the model class for table "token".
*
* The followings are the available columns in table 'token':
*/
class Token extends CToken {

    const HASH_LENGTH = 64;

    const TYPE_PRIVATE = 'Private';
    const TYPE_PUBLIC = 'Public';

    public function setRandomToken() {
        $this->hash = md5('random'.microtime(true)).md5(uniqid());
    }

}
