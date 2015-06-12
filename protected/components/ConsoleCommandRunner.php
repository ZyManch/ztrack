<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 12.06.2015
 * Time: 14:12
 */
class ConsoleCommandRunner extends CConsoleCommandRunner {

    public function run($args)
    {
        unset($args[1]);
        return parent::run(array_values($args));
    }
}