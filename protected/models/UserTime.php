<?php

/**
* This is the model class for table "user_time".
*
* The followings are the available columns in table 'user_time':
*/
class UserTime extends CUserTime {


    public function getCurrentTime() {
        if ($this->isNewRecord) {
            return '00:00:00';
        }
        $started = strtotime($this->started);
        $now = DateFormatter::getCurrentTimestamp();
        $currentTime = $now - $started;
        $hours = floor($currentTime/3600);
        $seconds = $currentTime%3600;
        $minutes = floor($seconds/60);
        $seconds = $seconds%60;
        return sprintf(
            '%02s:%02s:%02s',
            $hours,
            $minutes,
            $seconds
        );
    }

}
