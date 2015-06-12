<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 12.06.2015
 * Time: 14:10
 */
class ConsoleApplication extends CConsoleApplication {

    protected function createCommandRunner()
    {
        return new ConsoleCommandRunner;
    }

}