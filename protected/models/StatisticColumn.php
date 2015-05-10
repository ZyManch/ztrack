<?php

/**
* This is the model class for table "statistic_column".
*
* The followings are the available columns in table 'statistic_column':
*/
class StatisticColumn extends CStatisticColumn {

    const TYPE_INT = 'Int';
    const TYPE_FLOAT = 'Float';
    const TYPE_DATE = 'Date';
    const TYPE_STRING = 'String';

    protected function instantiate($attributes) {
        $class = ucfirst($attributes['type']).'StatisticColumn';
        $model=new $class(null);
        return $model;
    }

    /**
     * @return AbstractStatisticColumn[]
     */
    public static function getAvailableTypes() {
        return array(
            self::TYPE_INT => new IntStatisticColumn(),
            self::TYPE_FLOAT => new FloatStatisticColumn(),
            self::TYPE_DATE => new DateStatisticColumn(),
            self::TYPE_STRING => new StringStatisticColumn(),
        );
    }

}
