<?php

class Model_Register extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->createTable();
    }
    public function createTable()
    {
        $this->resource->query("
        CREATE TABLE IF NOT EXISTS `sap_login` (
          `login_id`             INT(5)           NOT NULL AUTO_INCREMENT,
          `login`                VARCHAR(32)      NULL NULL,
          `password`             VARCHAR(100)     NULL NULL,
          `email`                VARCHAR(128)      NULL NULL,
          PRIMARY KEY (`login_id`)
        )
          ENGINE =InnoDB
          DEFAULT CHARSET = utf8
          COMMENT ='Login Id';
                ");

    }
    public function save($data)
    {

        $stmt = $this->resource->prepare("INSERT INTO `sap_login` (
            `login`,
            `password`,
            `email`
            ) values (
            :login,
            :password,
            :email
            )");

        $pass = md5(trim($data['password']));
        $login = trim($data['login']);
        $email = trim($data['email']);

        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $pass);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $this->resource->lastInsertId();
    }

}