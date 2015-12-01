<?php
include_once('Logger/LoggerClass.php');

class TechDivision_Example {

    protected $_names = array();

    public function __construct($names) {
        $this->setNames($names);
    }
    public function setNames($names) {
        $this->_names = $names;
    }
    public function getNames() {
        return $this->_names;
    }

     public function renderNamesSorted() {
         usort($this->_names, array("TechDivision_Example", "cmp_obj"));
         $log = Test\Techdevision\Logger\LoggerClass::getInstance();
         foreach ($this->_names as $item) {
             $log->getLog(3, $this->createMessage($item));
             echo $item . "\n";
         }
     }

    function createMessage($message){
       return get_class($this) .'[info]  '. date('Y-M-D h:i:s', time()). ' - ' .  __LINE__ .' ' . $message ."\n";
    }

    static function cmp_obj($a, $b)
    {
        $al = strtolower($a);
        $bl = strtolower($b);
        if ($al == $bl) {
            return 0;
        }
        return ($al < $bl) ? +1 : -1;
    }
}

$names = array(
    'Tim Wagner',
    'Johann Zelger',
    'Stefan Willkommer');

$example = new TechDivision_Example($names);
$example->renderNamesSorted();

