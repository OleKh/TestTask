<?php

class Db
{

    private $host = HOSTNAME;
    private $user = USERNAME;
    protected $pass = PASSWORD;
    private $db = DATABASE;
    public $conn;
    public $resource;

    public function __construct()
    {
        $this->resource = $this->connect($this->host, $this->user, $this->pass, $this->db);
    }

    public function getResource($host, $user, $pass, $db)
    {
        return $this->connect($host, $user, $pass, $db);
    }

    public function connect($host = 'localhost', $user = 'root', $pass = '', $db = '')
    {

        if (is_object($this->conn)) {
            return $this->conn;
        } else {
            $this->host = $host;
            $this->user = $user;
            $this->pass = $pass;
            $this->db = $db;
            try {
                $dsn = 'mysql:host=' . $this->host . '; dbname=' . $this->db;
                $this->conn = new PDO (
                    $dsn, $this->user,
                    $this->pass,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            return $this->conn;
        }
    }
}
