<?php
namespace Test\Techdevision\Logger;
include_once('LoggerAbstract.php');

class LoggerClass extends LoggerAbstract{

    private static $instance;

    const LOG_PATH  = '/var/log/apache2/*.log'; // permission denied

    const LOG_APP_PATH  = 'log';

    public static function getInstance (){
        if(empty(self::$instance)) {
            self::$instance = new LoggerClass ();
        }
        return self::$instance;
    }

    protected function _log($logLevel, $message, $line = NULL)
    {
        error_log($message, $logLevel, self::LOG_APP_PATH);
    }
    public function info($message, $line = NULL){

    }
    public function warning($message, $line = NULL){

    }
    public function error($message, $line = NULL){

    }

    public function getLog($logLevel, $message, $line = NULL){
         $this->_log($logLevel, $message, $line);
    }
} 