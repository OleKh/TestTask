<?php
ini_set('display_errors', 0);

class Test_Setup
{
    public $db;
    public function __construct (){
        include($_SERVER['DOCUMENT_ROOT'] . '/lib/Db/connect.php');
        $this->db = $db = Db::connect();;
    }

    public function createTables()
    {
        $this->db->query("
        CREATE TABLE `avto_voe` (
          `avto_id`               INT(5)           NOT NULL AUTO_INCREMENT,
          `marka_avto`            VARCHAR(32)      NOT NULL DEFAULT '',
          `gos_number`            VARCHAR(16)      NOT NULL DEFAULT '',
          `type_avto`             VARCHAR(16)      NOT NULL DEFAULT '',
          `fio_voditel`           VARCHAR(32)      NOT NULL DEFAULT '',
          `marka_topliva`         VARCHAR(16)      NOT NULL DEFAULT '',
          `rashod_topliva`        DECIMAL(12, 4)   NOT NULL DEFAULT '0.0000',
          `odometr_last_month`    INT(10) UNSIGNED NOT NULL,
          `odometr_current_month` INT(10) UNSIGNED NOT NULL,
          PRIMARY KEY (`avto_id`),
          INDEX (`marka_avto`)
        )
          ENGINE =InnoDB
          DEFAULT CHARSET = utf8
          COMMENT ='Avto VOE';
                ");

          $this->db->query("
         CREATE TABLE `avto_toplivo_voe` (
          `toplivo_id`    INT(5)         NOT NULL AUTO_INCREMENT,
          `type_topliva`  VARCHAR(16)    NOT NULL DEFAULT '',
          `marka_topliva` VARCHAR(16)    NOT NULL DEFAULT '',
          `price_toplivo` DECIMAL(12, 4) NOT NULL DEFAULT '0.0000',
          PRIMARY KEY (`toplivo_id`),
          INDEX (`marka_topliva`)
        )
          ENGINE =InnoDB
          DEFAULT CHARSET = utf8
          COMMENT = 'Avto Toplivo VOE';
        ");

    }

    public function insertData()
    {
        include($_SERVER['DOCUMENT_ROOT'] . '/lib/Excel/PHPExcel/IOFactory.php');
        $inputFileName = $_SERVER['DOCUMENT_ROOT'] . '/excel/data.xls';
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objReader->setReadDataOnly(false);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                NULL,
                TRUE,
                FALSE);
            $stmt = $this->db->prepare("INSERT INTO `avto_voe` (
            `marka_avto`,
            `gos_number`,
            `type_avto`,
            `fio_voditel`,
            `marka_topliva`,
            `rashod_topliva`,
            `odometr_last_month`,
            `odometr_current_month`
            ) values (
            :marka_avto,
            :gos_number,
            :type_avto,
            :fio_voditel,
            :marka_topliva,
            :rashod_topliva,
            :odometr_last_month,
            :odometr_current_month
            )");
            $stmt->bindParam(':marka_avto', trim($rowData[0][1]));
            $stmt->bindParam(':gos_number', trim($rowData[0][2]));
            $stmt->bindParam(':type_avto',  trim($rowData[0][3]));
            $stmt->bindParam(':fio_voditel', trim($rowData[0][4]));
            $stmt->bindParam(':marka_topliva', trim($rowData[0][5]));
            $stmt->bindParam(':rashod_topliva', trim($rowData[0][6]));
            $stmt->bindParam(':odometr_last_month', trim($rowData[0][7]));
            $stmt->bindParam(':odometr_current_month', trim($rowData[0][8]));
            $stmt->execute();
        }

        $sheet = $objPHPExcel->getSheet(1);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                NULL,
                TRUE,
                FALSE);
            $stmt = $this->db->prepare("INSERT INTO `avto_toplivo_voe` (
            `type_topliva`,
            `marka_topliva`,
            `price_toplivo`
             ) values (
            :type_topliva,
            :marka_topliva,
            :price_toplivo
            )");
            $stmt->bindParam(':type_topliva', trim($rowData[0][1]));
            $stmt->bindParam(':marka_topliva', trim($rowData[0][2]));
            $stmt->bindParam(':price_toplivo',  trim($rowData[0][3]));
            $stmt->execute();
        }
    }
}

$obj = new Test_Setup();
$obj->createTables();
$obj->insertData();
