<?php

class Model_Account extends Model {

    public function __construct()
    {
        parent::__construct();
        $this->createTable();
    }
    public function createTable()
    {
        $this->resource->query("
        CREATE TABLE IF NOT EXISTS `sap_account` (
          `account_id`           INT(5)           NOT NULL AUTO_INCREMENT,
          `login_id`             int(5)           NULL NULL,
          `firstname`            VARCHAR(32)      NULL NULL,
          `lastname`             VARCHAR(32)      NULL NULL,
          `dob`                  VARCHAR(10)       NULL NULL,
          `sex`                  VARCHAR(1)        NULL NULL,
          `address`              VARCHAR(256)      NULL NULL,
          `telephone`            VARCHAR(128)      NULL NULL,
          PRIMARY KEY (`account_id`)
        )
          ENGINE =InnoDB
          DEFAULT CHARSET = utf8
          COMMENT ='Account Information';
                ");

    }
    public function save($data)
    {
        $stmt = $this->resource->prepare("INSERT INTO `sap_account` (
            `login_id`,
            `firstname`,
            `lastname`,
            `dob`,
            `sex`,
            `address`,
            `telephone`
            ) values (
            :login_id,
            :firstname,
            :lastname,
            :dob,
            :sex,
            :address,
            :telephone
            )");

        $login_id = (int) $data['login_id'];
        $firstname = trim($data['firstname']);
        $lastname = trim($data['lastname']);
        $dob = trim($data['dob']);
        $sex = trim($data['sex']);
        $address = trim($data['address']);
        $telephone = trim($data['telephone']);

        $stmt->bindParam(':login_id', $login_id);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':dob',  $dob );
        $stmt->bindParam(':sex', $sex);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->execute();
        return $this->resource->lastInsertId();
    }

}