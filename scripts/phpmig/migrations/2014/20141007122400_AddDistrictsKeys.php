<?php

use MyPhpmig\Police\Migration;

class AddDistrictsKeys extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->_queries = <<<END
ALTER TABLE `districts_districts_officers` DROP FOREIGN KEY `districts_districts_officers__districts_district_id`;
ALTER TABLE `districts_districts_officers` DROP FOREIGN KEY `districts_districts_officers__districts_officer_id`;
ALTER TABLE `districts_districts_officers` DROP INDEX `districts_districts_officers__districts_officer_id`;

ALTER TABLE `districts_relations` DROP FOREIGN KEY `districts_relations__districts_district_id`;
ALTER TABLE `districts_relations` DROP INDEX `districts_relations__districts_district_id`;

ALTER TABLE `districts` DROP PRIMARY KEY;
ALTER TABLE `districts_officers` DROP PRIMARY KEY;
ALTER TABLE `districts_districts_officers` DROP PRIMARY KEY;

ALTER TABLE `districts_officers` ADD `islp` VARCHAR(250)  NULL  DEFAULT NULL AFTER `districts_officer_id`;
UPDATE `districts_officers` SET `islp` = `districts_officer_id`;
SET @value :=0; UPDATE districts_officers SET districts_officer_id = (@value := @value + 1);

ALTER TABLE `districts` ADD `islp` VARCHAR(250)  NULL  DEFAULT NULL  AFTER `contacts_contact_id`;
UPDATE `districts` SET `islp` = `districts_district_id`;
ALTER TABLE `districts` ADD UNIQUE INDEX (`islp`);
SET @value :=0; UPDATE districts SET districts_district_id = (@value := @value + 1);

UPDATE `districts_relations` AS `relation`, `districts` AS `district` SET `relation`.`districts_district_id` = `district`.`districts_district_id` WHERE `relation`.`districts_district_id` = `district`.`islp`;
UPDATE `districts_districts_officers` AS `relation`, `districts` AS `district` SET `relation`.`districts_district_id` = `district`.`districts_district_id` WHERE `relation`.`districts_district_id` = `district`.`islp`;
UPDATE `districts_districts_officers` AS `relation`, `districts_officers` AS `officer` SET `relation`.`districts_officer_id` = `officer`.`districts_officer_id` WHERE `relation`.`districts_officer_id` = `officer`.`islp`;

ALTER TABLE `districts_districts_officers` CHANGE `districts_district_id` `districts_district_id` INT(11)  NOT NULL;

ALTER TABLE `districts` ADD PRIMARY KEY (`districts_district_id`);
ALTER TABLE `districts_officers` ADD PRIMARY KEY (`districts_officer_id`);
ALTER TABLE `districts_districts_officers` ADD PRIMARY KEY (`districts_district_id`, `districts_officer_id`);

ALTER TABLE `districts` CHANGE `districts_district_id` `districts_district_id` INT(11)  NOT NULL  AUTO_INCREMENT;
ALTER TABLE `districts_officers` CHANGE `districts_officer_id` `districts_officer_id` INT(11)  UNSIGNED  NOT NULL  AUTO_INCREMENT;
ALTER TABLE `districts_relations` CHANGE `districts_district_id` `districts_district_id` INT(11)  NOT NULL;

ALTER TABLE `districts_relations` ADD CONSTRAINT `districts_relations__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `districts_districts_officers` ADD CONSTRAINT `districts_districts_officers__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `districts_districts_officers` ADD CONSTRAINT `districts_districts_officers__districts_officer_id` FOREIGN KEY (`districts_officer_id`) REFERENCES `districts_officers` (`districts_officer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

UPDATE `attachments_relations` AS `relation`, `districts_officers` AS `officer` SET `relation`.`row` = `officer`.`districts_officer_id` WHERE `relation`.`row` = `officer`.`islp` AND `relation`.`table` = 'districts_officers';
UPDATE `activities` AS `activity`, `districts_officers` AS `officer` SET `activity`.`row` = `officer`.`districts_officer_id` WHERE `activity`.`row` = `officer`.`islp` AND `activity`.`name` = 'officer';
UPDATE `activities` AS `activity`, `districts` AS `district` SET `activity`.`row` = `district`.`districts_district_id` WHERE `activity`.`row` = `district`.`islp` AND `activity`.`name` = 'district';
END;
        parent::up();
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $this->_queries = <<<END
UPDATE `attachments_relations` AS `relation`, `districts_officers` AS `officer` SET `relation`.`row` = `officer`.`islp` WHERE `relation`.`row` = `officer`.`districts_officer_id` AND `relation`.`table` = 'districts_officers';
UPDATE `activities` AS `activity`, `districts_officers` AS `officer` SET `activity`.`row` = `officer`.`islp` WHERE `activity`.`row` = `officer`.`districts_officer_id` AND `activity`.`name` = 'officer';
UPDATE `activities` AS `activity`, `districts` AS `district` SET `activity`.`row` = `district`.`islp` WHERE `activity`.`row` = `district`.`districts_district_id` AND `activity`.`name` = 'district';

ALTER TABLE `districts_districts_officers` DROP FOREIGN KEY `districts_districts_officers__districts_district_id`;
ALTER TABLE `districts_districts_officers` DROP FOREIGN KEY `districts_districts_officers__districts_officer_id`;
ALTER TABLE `districts_districts_officers` DROP INDEX `districts_districts_officers__districts_officer_id`;

ALTER TABLE `districts_relations` DROP FOREIGN KEY `districts_relations__districts_district_id`;
ALTER TABLE `districts_relations` DROP INDEX `districts_relations__districts_district_id`;

ALTER TABLE `districts_districts_officers` CHANGE `districts_district_id` `districts_district_id` VARCHAR(250)  NOT NULL;
ALTER TABLE `districts_relations` CHANGE `districts_district_id` `districts_district_id` VARCHAR(250)  NOT NULL;
ALTER TABLE `districts_officers` CHANGE `districts_officer_id` `districts_officer_id` INT(11)  UNSIGNED  NOT NULL;
ALTER TABLE `districts` CHANGE `districts_district_id` `districts_district_id` VARCHAR(250)  NOT NULL;

ALTER TABLE `districts` DROP PRIMARY KEY;
ALTER TABLE `districts_officers` DROP PRIMARY KEY;
ALTER TABLE `districts_districts_officers` DROP PRIMARY KEY;

UPDATE `districts_districts_officers` AS `relation`, `districts` AS `district` SET `relation`.`districts_district_id` = `district`.`islp` WHERE `relation`.`districts_district_id` = `district`.`districts_district_id`;
UPDATE `districts_districts_officers` AS `relation`, `districts_officers` AS `officer` SET `relation`.`districts_officer_id` = `officer`.`islp` WHERE `relation`.`districts_officer_id` = `officer`.`districts_officer_id`;

UPDATE `districts_relations` AS `relation`, `districts` AS `district` SET `relation`.`districts_district_id` = `district`.`islp` WHERE `relation`.`districts_district_id` = `district`.`districts_district_id`;

UPDATE `districts_officers` SET `districts_officer_id` = `islp`;
ALTER TABLE `districts_officers` DROP `islp`;

UPDATE `districts` SET `districts_district_id` = `islp`;
ALTER TABLE `districts` DROP `islp`;

ALTER TABLE `districts` ADD PRIMARY KEY (`districts_district_id`);
ALTER TABLE `districts_officers` ADD PRIMARY KEY (`districts_officer_id`);
ALTER TABLE `districts_districts_officers` ADD PRIMARY KEY (`districts_district_id`, `districts_officer_id`);

ALTER TABLE `districts_districts_officers` ADD CONSTRAINT `districts_districts_officers__districts_officer_id` FOREIGN KEY (`districts_officer_id`) REFERENCES `districts_officers` (`districts_officer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `districts_districts_officers` ADD CONSTRAINT `districts_districts_officers__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `districts_relations` ADD CONSTRAINT `districts_relations__districts_district_id` FOREIGN KEY (`districts_district_id`) REFERENCES `districts` (`districts_district_id`) ON DELETE CASCADE ON UPDATE CASCADE;
END;

        parent::down();
    }
}
