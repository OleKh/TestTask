<?php
namespace Test\Techdevision\Logger;
include_once('LoggerClass.php');

class Logger
{
    public function __construct (){
        $log = LoggerClass::getInstance();
        $log->getLog(3, 'message');
    }
}

//new Logger;

