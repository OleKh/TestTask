<?php
namespace Test\Techdevision\Logger;

interface LoggerInterface {
    public function info($message, $line = NULL);
    public function warning($message, $line = NULL);
    public function error($message, $line = NULL);
}
