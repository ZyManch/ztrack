<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 10.05.2015
 * Time: 11:50
 */
abstract class AbstractStatisticColumn extends StatisticColumn {


    abstract public function getFormatList();

    abstract public function getFilterList();

    abstract public function getCompareRelationName();

}