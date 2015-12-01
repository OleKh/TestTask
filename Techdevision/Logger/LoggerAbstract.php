<?php
namespace Test\Techdevision\Logger;
use Test\Techdevision\Logger\LoggerInterface;

include_once('LoggerInterface.php');

abstract class LoggerAbstract implements LoggerInterface
{

    protected abstract function  _log($logLevel, $message, $line = NULL);

} 