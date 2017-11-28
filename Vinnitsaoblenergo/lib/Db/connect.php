<?php
class Db {

    static private $host;
    static private $user;
    static protected $pass;
    static private $db;
    static public $conn;

    static function connect ($host = 'localhost', $user = 'root', $pass = '181276', $db= 'voe_test'){

        if(is_object(self::$conn)) {
            return self::$conn;
        } else {
            self::$host = $host;
            self::$user =  $user;
            self::$pass = $pass;
            self::$db = $db;
       try {
           $dsn = 'mysql:host='.self::$host.'; dbname='.self::$db;
           self::$conn = new PDO (
               $dsn, self::$user,
               self::$pass,
               array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
           );
           self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e){
           echo $e->getMessage();
        }
        return self::$conn;
        }
    }
}
