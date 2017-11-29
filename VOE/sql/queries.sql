/* Задание 2. */
CREATE DATABASE `voe_test` CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE TABLE `avto_voe` (
  `avto_id`     INT(5) NOT NULL AUTO_INCREMENT,
  `marka_avto`  varchar(32) NOT NULL default '' ,
  `gos_number`   varchar(16) NOT NULL default '',
  `type_avto`  varchar(16) NOT NULL default '',
  `fio_voditel`  varchar(32) NOT NULL default '',
  `marka_topliva`  varchar(16) NOT NULL default '',
  `rashod_topliva` decimal(12,4) NOT NULL default '0.0000',
  `odometr_last_month` int(10) unsigned NOT NULL,
  `odometr_current_month` int(10) unsigned NOT NULL,
  PRIMARY KEY (`avto_id`),
  INDEX (`marka_avto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Avto VOE'
;

CREATE TABLE `avto_toplivo_voe` (
  `toplivo_id`    INT(5) NOT NULL AUTO_INCREMENT,
  `type_topliva`  varchar(16) NOT NULL default '',
  `marka_topliva`    varchar(16) NOT NULL default '',
  `price_toplivo`     decimal(12,4) NOT NULL default '0.0000',
  PRIMARY KEY (`toplivo_id`),
  INDEX (`marka_topliva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT= 'Avto Toplivo VOE'
;

/* Задание 2.1. */
INSERT INTO `avto_voe` (
  `marka_avto`,
  `gos_number`,
  `type_avto`,
  `fio_voditel`,
  `marka_topliva`,
  `rashod_topliva`,
  `odometr_last_month`,
  `odometr_current_month`)
VALUES (
  'ГАЗ-52',
  'АВ2510ВИ',
  'грузовой',
  'Сидоров А.А.',
  'ДТ-З-К5',
  20.0000,
  100008,
  100508
)

/* Задание 2.2. */
UPDATE `avto_voe`
SET `odometr_current_month` = '100528'
WHERE `avto_voe`.`avto_id` = 10;

DELETE FROM `avto_voe`
WHERE `avto_voe`.`avto_id` = 10;

/* Задание 2.3. */
SELECT  *
FROM `avto_voe`
WHERE `type_avto` = 'легковой';

/* Задание 2.4. */
SELECT  *
FROM `avto_voe`
WHERE `type_avto` = 'грузовой'
      AND `marka_topliva` = 'ДТ-З-К5';